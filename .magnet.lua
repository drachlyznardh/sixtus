require 'rex_pcre'
rex = rex_pcre


-- -------------------- --
-- Configuration values --
-- -------------------- --

-- Canonical subdomain
canonical = 'gods'

-- Regular expressions matching forbidden URIs
forbidden = { }


-- ----------------- --
-- Utility functions --
-- ----------------- --

function hostsplit (host)
	-- Split a hostname into subdomain, domain and TLD

	local parts = {}

	for part, sep in rex.split (host, '\\.') do
		table.insert (parts, part)
	end

	local tld       = parts[#parts]
	local domain    = parts[#parts - 1]
	local subdomain = ''

	if #parts >= 3 then
		subdomain = parts[1]
		for i = 2, #parts - 2 do
			subdomain = subdomain .. '.' .. parts[i]
		end
	end

	return subdomain, domain, tld
end


-- ---------------------------- --
-- Global defines and variables --
-- ---------------------------- --

-- HTTP status codes
OK                = 200
MOVED_PERMANENTLY = 301
FOUND             = 302
FORBIDDEN         = 403
NOT_FOUND         = 404

-- URI parts
scheme  = lighty.env['uri.scheme']
host    = lighty.env['uri.authority']
uri     = lighty.env['uri.path']
docroot = lighty.env['physical.doc-root']

-- Host parts
subdomain, domain, tld = hostsplit (host)

-- Rewriting engine state
rewrite = {
	handler = lighty.env['physical.rel-path'],
	status  = OK,
	last    = false
}


-- ------------------------------- --
-- Rewriting rules (it sure does!) --
-- ------------------------------- --

-- Force access through canonical subdomain
if not rewrite.last then

	if subdomain ~= canonical then

		rewrite.handler = scheme .. '://'

		if canonical ~= '' then
			rewrite.handler = rewrite.handler .. canonical .. '.'
		end

		rewrite.handler = rewrite.handler .. domain .. '.' .. tld
		rewrite.handler = rewrite.handler .. uri
		rewrite.status = FOUND
		rewrite.last = true
	end
end

-- Forbid access to certain files
if not rewrite.last then

	for i = 1, #forbidden, 1 do
		if rex.match (uri, forbidden[i]) then
			rewrite.handler = '/handler.php'
			rewrite.status = FORBIDDEN
			rewrite.last = true
		end
	end
end

-- All the other documents are generated at request time
if not rewrite.last then

	rewrite.handler = '/d.php'
	rewrite.status = OK
	rewrite.last = true
end


-- ------------------------ --
-- Perform actual rewriting --
-- ------------------------ --

if rewrite.status == FOUND or
   rewrite.status == MOVED_PERMANENTLY or
   rewrite.status == NOT_FOUND
then

	-- Do a redirect and let the rewriting process start over
	-- print ('Redirect: ' .. rewrite.handler)
	lighty.header['Location'] = rewrite.handler
	return rewrite.status
else

	-- Pass the request to the designated handler
	-- print ('Request: ' .. uri .. ' => ' .. rewrite.handler)
	lighty.env['uri.path'] = rewrite.handler
	lighty.env['physical.rel-path'] = rewrite.handler
	lighty.env['physical.path'] = docroot .. rewrite.handler
end
