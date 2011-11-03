<?php
	$title=array('La scimmia celeste',
		'E il suo incredibile intelligente semplice stile', 'intro');
	$prev = array ('Extra/Record/', 'Record');
	$sides[] = function ($d) {
?>
		<div class="section">
			<p>
				<?=$d->mktid('Celestial Monkey Style','intro')?>
			</p><h2 class="reverse">
				Prodigi
			</h2><p>
				<?=$d->mktid('Monkey Tail Distraction Strike', 'i')?>
			</p><p>
				<?=$d->mktid('Flowing Mirrof', 'ii')?>
			</p><p class="reverse">
				<?=$d->mktid('of Opposition Technique', 'ii')?>
			</p><p>
				<?=$d->mktid('Body of War Meditation', 'iii')?>
			</p><p>
				<?=$d->mktid('Withering Paw Strike', 'iv')?>
			</p><p>
				<?=$d->mktid('Celestial Monkey Form', 'v')?>
			</p><p>
				<?=$d->mktid('Walking in the Footsteps', 'vi')?>
			</p><p class="reverse">
				<?=$d->mktid('of Ten Thousands Things', 'vi')?>
			</p><p>
				<?=$d->mktid('Four Halo Golden Monkey Palm', 'vii')?>
			</p><p>
				<?=$d->mktid('Four Halo', 'viii')?>
			</p><p class="reverse">
				<?=$d->mktid('Golden Monkey Realignment', 'viii')?>
			</p><p>
				<?=$d->mktid('Celestial Godbody Understanding', 'ix')?>
			</p>
		</div>
<?php
	};
	$pages[] = function ($d) {
?>
<div class="small">
	<?php if ($d->mktab('intro')) { ?><div class="section">
		<h2>
			Celestial Monkey Style
		</h2><p>
			The monkey is sharp and clever, sagacious in his simple way. The nimble,
			quick-witted animal seldom worries about danger and never about failure.
			Should a snake or tiger come close, the monkey simply jumps to another
			tree. Should he fail to collect one sweet fruit or shiny trinket, why,
			there’s always another. To envious, ground-bound humans, the monkey
			seems to live with neither toil nor fear, carefree as the immortal
			gods.
		</p><p>
			These mortals obviously don’t know about the laborious bureaucracy of
			Yu-Shan; many a god would envy a monkey’s life as well. Nevertheless,
			some martial artists draw inspiration from the monkey’s careless
			self-assurance as well as its agility. Students of the Celestial Monkey
			Style practice acrobatic katas and meditate on jokes and paradoxes. Much
			of their training centers on acting without conscious thought. Some
			sages see the impulsive monkey as a symbol of an unfocused, distracted
			mind but practitioners of this martial art see the monkey as a paragon
			of quick, flexible response. They all seek to achieve the monkey’s happy
			self-confidence and wide-eyed joy at the world. Those who do so earn the
			nickname Blissful Sages and become some of the most talented and
			unsinkable martial artists roaming free across Creation.
		</p><p>
			Blissful Sages don’t spare much respect for anyone or anything,
			including themselves. They avoid strong passions that could channel
			their attention too narrowly. As a result, no Blissful Sage has any
			Virtue rated higher than 3. A higher rating indicates a degree of
			obsession that an enemy could exploit or that could distract a
			practitioner from complete awareness of the world. No character with a
			Virtue rated 4 or higher can learn this style, and if a Blissful Sage
			raises one of his Virtues higher than 3, he can no longer use the
			style’s Charms.
		</p><p>
			<span class="em">Weapons and Armor</span>: This martial art is an
			unarmed style only, and characters cannot use this style while wearing
			armor. Only masters of this style can escape these prohibitions. (See
			the Charm Celestial Godbody Understanding for details.)
		</p><p>
			<span class="em">Complementary Skills</span>: Celestial Monkey
			practitioners do not need specific ratings in other Abilities to learn
			this martial art. That said, they often develop great skill at Dodge and
			Athletics for agility, Awareness for comprehensive observation of their
			surroundings and Integrity for a self-possessed mind that evades outside
			influences.
		</p>
	</div><?php } if ($d->mktab('i')) { ?><div class="section">
		<h2>
			Monkey Tail Distraction Strike
		</h2><p>
			<span class="em">Cost</span>: 2m;
			<span class="em">Mins</span>: Martial Arts 2, Essence 1;
			<span class="em">Type</span>: Simple
		</p><p>
			<span class="em">Keywords</span>: Combo-OK
		</p><p>
			<span class="em">Duration</span>: Instant
		</p><p>
			<span class="em">Prerequisite Charms</span>: None
		</p>
	</div><div class="section">
		<div class="outside"><p>
			The Exalt can move from a perfectly relaxed pose to strike her opponent
			unexpectedly, ambushing him despite being in full view.
		</p></div><p>
			The Charm can be used only before combat starts. When the martial artist
			activates this Charm and makes a Martial Arts attack, her opponent’s
			player attempts a reflexive (<span class="em">Perception +
			Awareness</span>) roll with a difficulty equal to the martial artist’s
			permanent Essence.
		</p><p>
			If this roll fails, the Exalt’s opponent cannot apply his Dodge or Parry
			DV to this attack without the use of reflexive surprise-mitigating
			Charms. If the roll succeeds, the martial artist’s attack roll is
			subject to the victim’s Dodge or Parry DV.
		</p><p>
			Only after the attack granted by this Charm is complete does combat
			begin, at which point the player of every character involved rolls Join
			Battle. The Speed of the surprise attack granted by this Charm is not
			taken into account for the purposes of determining when on the reaction
			count the martial artist’s next action occurs. The result of her Join
			Battle roll determines her position on the reaction count normally.
		</p>
	</div><?php } if ($d->mktab('ii')) { ?><div class="section">
		<h2>
			Flowing Mirror of Opposition Technique
		</h2><p>
			<span class="em">Cost</span>: 1m; <span class="em">Mins</span>: Martial Arts 2, Essence 1;
		</p><p>
			<span class="em">Type</span>: Reflexive (Step 1 or 2)
		</p><p>
			<span class="em">Keywords</span>: Combo-OK, Obvious
		</p><p>
			<span class="em">Duration</span>: Instant
		</p><p>
			<span class="em">Prerequisite Charms</span>: Monkey Tail Distraction Strike
		</p>
	</div><div class="section">
		<div class="outside"><p>
			This Charm makes its user frustratingly hard to attack. The Exalt
			engages his opponent and dances around her like a monkey, moving
			alternately too close for proper leverage and tantalizingly out of reach
			in no predictable pattern.
		</p></div><p>
			This ridiculous capering subtracts two from the <span
			class="em">Accuracy</span> modifier of the opponent’s attack.
		</p><p>
			The Blissful Sage can also attack more quickly, adding his <span
			class="em">Essence</span> to his <span class="em">Join Battle</span>
			dice pool at the start of combat and subtracting one tick from the Speed
			of his attack.
		</p>
	</div><?php } if ($d->mktab('iii')) { ?><div class="section">
		<h2>
			Body of war meditation
		</h2><p>
			<span class="em">Cost</span>: 4m or 6m; <span class="em">Mins</span>: Martial Arts 3, Essence 2;
		</p><p>
			<span class="em">Type</span>: Simple
		</p><p>
			<span class="em">Keywords</span>: Obvious, Stackable
		</p><p>
			<span class="em">Duration</span>: One scene
		</p><p>
			<span class="em">Prerequisite Charms</span>: None
		</p>
	</div><div class="section">
		<p>
			The Exalt practices a meditative prana for about 20 minutes, channeling
			powerful Essence.
		</p><div class="outside"><p>
			Doing so suffuses her muscles with fluid suppleness, and her bones and
			skin are fortified with power and flexibility. For the rest of the
			scene, faint pulses of golden Essence radiate from the martial artist’s
			core chakras in time with her heartbeat, running down her arms and legs
			and up to the crown chakra in the center of her forehead. The Exalt’s
			caste mark also becomes visible.
		</p></div><p>
			For every <span class="em">four motes</span> of Essence the martial
			artist spends, add one temporary dot to her <span class="em">Strength or
			Stamina</span>; or for every <span class="em">six motes</span> of
			Essence, add one temporary dot to her <span
			class="em">Dexterity</span>.
		</p><p>
			Body of War Meditation can be used more than once for the same scene,
			but it cannot be used once the character enters combat. The effects are
			cumulative, and the Exalt’s Attributes can be raised thus above trait
			maximums.
		</p><p>
			The character cannot raise any of her Physical Attributes by more dots
			than she has permanent Essence, however.
		</p>
	</div><?php } if ($d->mktab('iv')) { ?><div class="section">
		<h2>
			Withering Paw Strike
		</h2><p>
			<span class="em">Cost</span>: 4m, 1wp;
			<span class="em">Mins</span>: Martial Arts 3, Essence 2;
		</p><p>
			<span class="em">Type</span>: Simple
		</p><p>
			<span class="em">Keywords</span>: Combo-OK, Touch
		</p><p>
			<span class="em">Duration</span>: Instant
		</p><p>
			<span class="em">Prerequisite Charms</span>: Body of War Meditation
		</p>
	</div><div class="section">
		<div class="outside"><p>
			With this Charm, the martial artist attacks his opponent’s weapon arm in
			an attempt to disarm him.
		</p></div><p>
			The Exalt’s player rolls a (<span class="em">Dexterity + Martial
			Arts</span>) attack at a difficulty of 1, disregarding the standard -2
			penalty for attempts to disarm. The target’s DV applies as if the attack
			were a normal one, but the DV suffers a penalty equal to the attacker’s
			permanent Essence.
		</p><p>
			If the attacker succeeds, the target’s player must attempt a reflexive
			roll of (<span class="em">Wits + the weapon’s pertinent Ability</span>)
			per the normal rules. If she fails this roll, her weapon is flung a
			number of yards equal to the martial artist’s extra successes. The
			weapon flies off in a direction of the martial artist’s choosing, or the
			Exalt may take it for himself and pass it to someone else if she
			pleases.
		</p>
	</div><?php } if ($d->mktab('v')) { ?><div class="section">
		<h2>
			Celestial Monkey Form
		</h2><p>
			<span class="em">Cost</span>: 5m;
			<span class="em">Mins</span>: Martial Arts 4, Essence 2;
		</p><p>
			<span class="em">Type</span>: Simple (Speed 3)
		</p><p>
			<span class="em">Keywords</span>: Form-type
		</p><p>
			<span class="em">Duration</span>: One scene
		</p><p>
			<span class="em">Prerequisite Charms</span>: Flowing Mirror of
			Opposition, Withering Paw Strike
		</p>
	</div><div class="section">
		<div class="outside"><p>
				The state of careless confidence to which disciples of this style
				aspire is known as the “<span class="em">Selfless Mind</span>”.
			</p><p>
				Practitioners divorce themselves from emotions or other distractions
				that would undermine their confidence or make them doubt their
				chances of success or chosen course of action. Celestial Monkey Form
				is the perfect expression of that ability. The martial artist
				centers herself and spends the motes necessary to fuel the Charm.
				Her body relaxes as she releases her mind from the expectations of
				society and her own inner turmoil between emotion and intellect.
			</p><p>
				Free for the time being, the martial artist smiles blissfully.
		</p></div><p>
			For the rest of the scene, the Exalt does <span class="em">not need to
			make Virtue tests</span>.
		</p><div class="outside"><p>
				Gibbering bands of demon-soldiers will not intimidate her on the
				battlefield, nor will the feeble pawings of elderly invalids
				distract her from pursuing her adversary.
		</p></div><p>
			She also becomes <span class="em">immune</span> to all forms of natural
			mental influence for the scene, regardless of how compatible such
			influence might be with her Motivation. Attempts to levy unnatural
			mental influence suffer a +1 external penalty (where applicable), and
			the martial artist does not gain Limit from using Willpower to resist.
		</p>
	</div><?php } if ($d->mktab('vi')) { ?><div class="section">
		<h2>
			Walking in the footsteps
		</h2><h2 class="reverse">
			of the thousand things
		</h2><p>
			<span class="em">Cost</span>: 10m, 1wp, 2xp;
			<span class="em">Mins</span>: Martial Arts 5, Essence 3;
		</p><p>
			<span class="em">Type</span>: Simple
		</p><p>
			<span class="em">Keywords</span>: None
		</p><p>
			<span class="em">Duration</span>: One scene (with Permanent aspects; see below)
		</p><p>
			<span class="em">Prerequisite Charms</span>: Celestial Monkey Form
		</p>
	</div><div class="section">
		<div class="outside"><p>
				By meditating on every aspect of the natural world around them,
				Blissful Sages can understand the manifold ways Essence flows
				through Creation.  By emulating the phenomena on which they meditate
				(by walking in the footsteps of ten thousand things), these martial
				artists guide Creation’s Essence to flow through them in the same
				manifold ways. In so doing, these learned masters perfect their
				martial skills and make themselves unassailable.
		</p></div><p>
			To use this Charm, a martial artist must first size up his opponent,
			either by fighting him, watching him demonstrate his style or watching
			him fight someone else. Studying an opponent in this way requires <span
			class="em">one full scene of observation</span>. After that fight or
			period of observation is over, the martial artist then meditates on his
			opponent for a period of <span class="em">one hour</span>, internalizing
			the lessons he learned in his observation.
		</p><p>
			Henceforth, whenever the martial artist faces that particular opponent,
			his player rolls (<span class="em">Perception + Martial Arts</span>)
			with a difficulty equal to that opponent’s Martial Arts score. If the
			roll succeeds, the Blissful Sage adds any successes above that
			difficulty to his own Martial Arts attacks against that opponent for one
			scene.
		</p><p>
			If the opponent learns a new martial arts style, however, the Blissful
			Sage loses this advantage until he spends another scene observing the
			opponent’s new combat techniques and uses this Charm again.
		</p>	
	</div><?php } if ($d->mktab('vii')) { ?><div class="section">
		<h2>
			Four halo golden monkey palm
		</h2><p>
			<span class="em">Cost: 3m, 1wp;
			<span class="em">Mins</span>: Martial Arts 5, Essence 3;
		</p><p>
			<span class="em">Type</span>: Supplemental
		</p><p>
			<span class="em">Keywords</span>: Combo-OK, Obvious
		</p><p>
			<span class="em">Duration</span>: Instant
		</p><p>
			<span class="em">Prerequisite Charms</span>: Walking in the Footsteps of
			Ten Thousand Things
		</p>
	</div><div class="section">
		<div class="outside"><p>
				Essence flows through all things, and supernatural martial arts
				provide a way to channel and direct this energy. Just as Essence
				concentrates in certain geographical nexus points known as <span
				class="em">demesnes</span>, so too do similar nexus points exist in
				the body. Blissful Sages pay special attention to four of these
				chakras, which they call the Gates of Virtue.
			</p><p>
				Celestial Monkey practitioners believe each gate is attuned to one
				of the Divine Virtues: the Crown of Temperance (head), the Chalice
				of Compassion (sternum), the Throne of Conviction (stomach) and the
				Root of Valor (groin).
			</p><p>
				When the martial artist invokes this Charm in combat, she sees
				glowing rings encircle these gates on her opponent, each of which
				glows with an intensity proportional to the strength of the
				corresponding Virtue. These rings provide more than knowledge about
				a foe’s personality.
		</p></div><p>
			The martial artist need only attempt an attack against one of these
			gates at a <span class="em">+3 external difficulty penalty</span>,
			rolling damage as usual. If any damage exceeds the target’s soak, the
			target suffers an additional amount of lethal damage equal to the Virtue
			whose chakra was struck.
		</p><p>
			<span class="em">Example</span>: The Blissful Sage Liu Fi toys with a
			very frustrated deathknight who just wants Liu Fi to succumb to the
			bleak inevitable.  Liu Fi opens his mind and perceives the deathknight’s
			four Gates of Virtue, discovering that his opponent is tightly centered
			around his Throne of Conviction. Liu Fi lands a reverse elbow-strike in
			the deathknight’s gut, inflicting one level of bashing damage over his
			opponent’s soak. The deathknight has a Conviction of 5, however, so he
			suffers five additional levels of lethal damage. As the deathknight
			drops to his knees clutching his midsection (thankful he wasn’t more
			brave than sure), Liu Fi takes the opportunity to excuse himself.
		</p>
	</div><?php } if ($d->mktab('viii')) { ?><div class="section">
		<h2>
			Four Halo Golden Monkey Realignment
		</h2><p>
			<span class="em">Cost</span>: 8m, 1wp;
			<span class="em">Mins</span>: Martial Arts 5, Essence 3;
		</p><p>
			<span class="em">Type</span>: Reflexive
		</p><p>
			<span class="em">Keywords</span>: Obvious
		</p><p>
			<span class="em">Duration</span>: One scene
		</p><p>
			<span class="em">Prerequisite Charms</span>: Four Halo Golden Monkey Palm
		</p>
	</div><div class="section">
		<div class="outside"><p>
				This Charm enables a Blissful Sage to manipulate her own Gates of
				Virtue, moving these nexus points within her frame. Doing so creates
				glowing, spherical fields of Essence around her body wherever she
				moves the gates, with a radius equal to the length of his forearm.
			</p><p>
				This realignment causes no disturbance within the martial artist,
				but those who witness him using this Charm see glittering coronas
				(colored like the Exalt’s anima banner) flare around the Exalt’s
				extremities.
		</p></div><p>
			The martial artist can use these haloes of Essence to parry any incoming
			attack, hand-to-hand or ranged, using her full (<span
			class="em">Dexterity + Martial Arts</span>) total as her Defense Value
			for the scene (not dividing the value by two, per her normal Parry DV).
			She does not need to move to do so either. The character only needs to
			be aware of the attacks and have enough Essence and Willpower to
			activate the Charm.
		</p>
	</div><?php } if ($d->mktab('ix')) { ?><div class="section">
		<h2>
			 Celestial Godbody understanding
		</h2><p>
			<span class="em">Cost</span>: —;
			<span class="em">Mins</span>: Martial Arts 5, Essence 4; Type: Permanent
		</p><p>
			<span class="em">Keywords</span>: None
		</p><p>
			<span class="em">Duration</span>: Permanent
		</p><p>
			<span class="em">Prerequisite Charms</span>: Four Halo Golden Monkey Realignment
		</p>
	</div><div class="section">
		<div class="outside"><p>
				Blissful masters of this martial art transcend its limits through
				their perfected consciousness of how Essence flows through the world
				and themselves.
		</p></div><p>
			After buying this Charm, the martial artist treats all attacks made
			using the Martial Arts Ability as unarmed attacks, even if he uses a
			weapon – including all the Charms of this style. Wearing armor no longer
			hinders the character from performing the Charms of this martial art,
			either.
		</p><p>
			If it matters, any Strength, Dexterity or Martial Arts minimums for the
			character’s weapons are halved (round up), so the Blissful Sage can
			wield weapons that seem like they should be too heavy for her. (This
			also helps the character if Charms, drugs or poisons reduce her
			Attributes below the listed minimums).
		</p>
	</div><?php } ?>
</div>
<?php } ?>
