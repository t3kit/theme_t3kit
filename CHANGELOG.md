
#### v2.10.0-alpha `January 4, 2019`

- **[TASK]** install cs_seo extension (#456) ([140062b](https://github.com/t3kit/theme_t3kit/commit/140062b))
- **[BUGFIX]** implement LoggerAwareInterface interface in order to get logger inject (#455) ([dfe0bc4](https://github.com/t3kit/theme_t3kit/commit/dfe0bc4))
- **[TASK]** setup default Gridelements options ([790b500](https://github.com/t3kit/theme_t3kit/commit/790b500))
- **[BUGFIX]** fix rendering of content elements inside gridelements columns (#454) ([78814ed](https://github.com/t3kit/theme_t3kit/commit/78814ed))
- **[BUGFIX]** fix gridelements templateRootPaths ([b36b185](https://github.com/t3kit/theme_t3kit/commit/b36b185))
- **[TASK]** update Gridelements extension to v9 ([30023da](https://github.com/t3kit/theme_t3kit/commit/30023da))
- **[BUGFIX]** use correct FlexFormService in FlexFormProcessor ([7c8db4e](https://github.com/t3kit/theme_t3kit/commit/7c8db4e))
- **[TASK]** update pxa_newsletter_subscription, form-enhancement and cookie-bar  ext-s ([c112243](https://github.com/t3kit/theme_t3kit/commit/c112243))
- **[BUGFIX]** use correct FlexFormService in FlexFormProcessor ([68554f3](https://github.com/t3kit/theme_t3kit/commit/68554f3))
- **[TASK]** remove usage of deprecated classes and functions. Log error if not possible to write to realurl config, instead of throwing exception ([217d628](https://github.com/t3kit/theme_t3kit/commit/217d628))
- **[TASK]** use argument source ([f4c9e02](https://github.com/t3kit/theme_t3kit/commit/f4c9e02))
- **[TASK]** register argument source ([a10f0a1](https://github.com/t3kit/theme_t3kit/commit/a10f0a1))
- **[TASK]** replace removed extRelPath ([e46e794](https://github.com/t3kit/theme_t3kit/commit/e46e794))
- **[TASK]** remove realurl, themes, dyncss, less-cs_seo, 404 extensions ([c54abb3](https://github.com/t3kit/theme_t3kit/commit/c54abb3))
- **[TASK]** use master branch for solr ext. ([58a823a](https://github.com/t3kit/theme_t3kit/commit/58a823a))
- **[TASK]** update cs_seo and go_maps_ext extensions ([8a97ecd](https://github.com/t3kit/theme_t3kit/commit/8a97ecd))
- **[TASK]** update PXA extensions ([bbad05e](https://github.com/t3kit/theme_t3kit/commit/bbad05e))
- **[TASK]** use last version of frontend-editing ext. 1.4.3 ([11874f0](https://github.com/t3kit/theme_t3kit/commit/11874f0))
- **[TASK]** use master branch for gridelements ext. ([ff27784](https://github.com/t3kit/theme_t3kit/commit/ff27784))
- **[TASK]** use master branch for NEWS ext. ([27a08c2](https://github.com/t3kit/theme_t3kit/commit/27a08c2))
- **[TASK]** update typo3 to v9.5 ([008cee4](https://github.com/t3kit/theme_t3kit/commit/008cee4))
- **[BUGFIX]** Fix packages names and solve dependancy to typo3-core to its packages (#452) ([6be2ed4](https://github.com/t3kit/theme_t3kit/commit/6be2ed4))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[TASK]** adapt grid templates to use with Gridelements v9 ([a78d995](https://github.com/t3kit/theme_t3kit/commit/a78d995))

***

#### v2.9.0 `October 26, 2018`
- **[BUGFIX]** fix collapsible element, fix the issue with collapsed class on the a-tag ([0cee30e](https://github.com/t3kit/theme_t3kit/commit/0cee30e))
- **[FEATURE]** add a preloader until slider container is initialized (#442) ([d134468](https://github.com/t3kit/theme_t3kit/commit/d134468))
- **[TASK]** register icons outside BE if-statement so it can show content element icons in frontend editing (#449) ([60f58de](https://github.com/t3kit/theme_t3kit/commit/60f58de))
- **[BUGFIX]** fix language menu label add missing comma (#445) ([f1a6e7c](https://github.com/t3kit/theme_t3kit/commit/f1a6e7c))
- **[TASK]** Adapting header style (#443) ([308552a](https://github.com/t3kit/theme_t3kit/commit/308552a))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[BUGFIX]** disable divider heading from being displayed (#444) ([a256c79](https://github.com/t3kit/theme_t3kit/commit/a256c79))

***

#### v2.8.0 `June 27, 2018`
- **[BUGFIX]** fix js error when ariaLabels object is empty in LogoCarousel CE ([abf817f](https://github.com/t3kit/theme_t3kit/commit/abf817f))
- **[BUGFIX]** add a possibility to choose an empty value for the column in Adv1ColumnGrid CE ([0b13c3e](https://github.com/t3kit/theme_t3kit/commit/0b13c3e))
- **[FEATURE]** add options for each slide to have a transparent background (#425) ([c4a9317](https://github.com/t3kit/theme_t3kit/commit/c4a9317))
- **[BUGFIX]** add possibility to have top/bottom margin of element inside parallax element (#434) ([245550b](https://github.com/t3kit/theme_t3kit/commit/245550b))
- **[BUGFIX]** use CSS color variable for social icons in footer (#433) ([bcd686f](https://github.com/t3kit/theme_t3kit/commit/bcd686f))
- **[BUGFIX]** add word wrap behavior for subnavigation items (#422) ([fdda947](https://github.com/t3kit/theme_t3kit/commit/fdda947))
- **[BUGFIX]** Use class for logo carousel aria labels (#426) ([13c03d9](https://github.com/t3kit/theme_t3kit/commit/13c03d9))
- **[BUGFIX]** jumping animation (clicking the header panel of collapsible) (#427) ([cb48742](https://github.com/t3kit/theme_t3kit/commit/cb48742))
- **[BUGFIX]** show more-link in newsSimpleList elem. ([da0767a](https://github.com/t3kit/theme_t3kit/commit/da0767a))
- **[TASK]** use object-fit-images as a component in felayout ([1b4d57a](https://github.com/t3kit/theme_t3kit/commit/1b4d57a))
- **[FEATURE]** Use <img> + object-fit in News ext. instead of background-images. Accessibility ([4a7bed6](https://github.com/t3kit/theme_t3kit/commit/4a7bed6))
- **[TASK]** make logo carousel linked logos same size as non linked logos. (#409) ([788496b](https://github.com/t3kit/theme_t3kit/commit/788496b))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[TASK]** update favicon settings, add msapplication-TileColor and site.webmanifest (favicongenerator) ([e954219](https://github.com/t3kit/theme_t3kit/commit/e954219))
- **[!!!]** **[BUGFIX]** Fix incorrect class of link in IconTextButton CE, fixes #419 (#420) ([dcc9e66](https://github.com/t3kit/theme_t3kit/commit/dcc9e66))
- **[!!!]** **[TASK]** Update Parallax (Jarallax), fix #423 (#424) ([f4bded1](https://github.com/t3kit/theme_t3kit/commit/f4bded1))
- **[!!!]** **[BUGFIX]** fix header middle social media icons (#432) ([d61162e](https://github.com/t3kit/theme_t3kit/commit/d61162e))

***

#### v2.7.0 `May 24, 2018`
- **[BUGFIX]** make conditions work within INCLUDE_TYPOSCRIPT by escape backslashes (#415) ([b3e7ee6](https://github.com/t3kit/theme_t3kit/commit/b3e7ee6))
- **[BUGFIX]** fix fluid parse error in News detail template ([52e08c1](https://github.com/t3kit/theme_t3kit/commit/52e08c1))
- **[TASK]** update dependencies (gridelements, TYPO3, cookie-bar) ([1f5392e](https://github.com/t3kit/theme_t3kit/commit/1f5392e))
- **[TASK]** use georgringer/news instead of typo3-ter/news package ([71dfe30](https://github.com/t3kit/theme_t3kit/commit/71dfe30))
- **[BUGFIX]** never upscaling smaller background images in bg image and contact cards elem. (#412) ([0864a20](https://github.com/t3kit/theme_t3kit/commit/0864a20))
- **[TASK]** added default column-value in 'Advanced one column grid' (col-md-12). (#414) ([db9b569](https://github.com/t3kit/theme_t3kit/commit/db9b569))
- **[TASK]** update npm devDependencies ([4ad8020](https://github.com/t3kit/theme_t3kit/commit/4ad8020))
- **[TASK]** update package-lock file (npm audit) ([8594842](https://github.com/t3kit/theme_t3kit/commit/8594842))
- **[BUGFIX]** don't create inline-css for background unless value exists. (#413) ([b9a1fcb](https://github.com/t3kit/theme_t3kit/commit/b9a1fcb))
- **[FEATURE]** make news detail page navigation display next and prev news item title & date (#390) ([c6c3b24](https://github.com/t3kit/theme_t3kit/commit/c6c3b24))
- **[TASK]** typoscript include contitions (#410) ([086f56c](https://github.com/t3kit/theme_t3kit/commit/086f56c))
- **[TASK]** update config for production mode (moveJsToFooter + inlineStyle) ([0376bda](https://github.com/t3kit/theme_t3kit/commit/0376bda))
- **[BUGFIX]** News detail view, fix teaser text font size (#408) ([0cffeb7](https://github.com/t3kit/theme_t3kit/commit/0cffeb7))
- **[BUGFIX]** news date menu, removed unneeded year from month name (#406) ([5930162](https://github.com/t3kit/theme_t3kit/commit/5930162))
- **[TASK]** felogin: Frontend validation (#401) ([ae26f12](https://github.com/t3kit/theme_t3kit/commit/ae26f12))

***

#### v2.6.0 `March 16, 2018`
- **[FEATURE]** added 'Lead' paragraph styling for CKEditor (#399) ([5684980](https://github.com/t3kit/theme_t3kit/commit/5684980))
- **[BUGFIX]** fix main menu sub list not overlaying other menu items. (#395) ([8aa1704](https://github.com/t3kit/theme_t3kit/commit/8aa1704))
- **[BUGFIX]** Reactivate usage of news detail page constant for solr index (#397) ([ec5e388](https://github.com/t3kit/theme_t3kit/commit/ec5e388))
- **[FEATURE]** New Social Media Option in Theme configuration (#398) ([342181a](https://github.com/t3kit/theme_t3kit/commit/342181a))
- **[DOC]** update felayout README, update required dependencies (node/npm) ([80ce262](https://github.com/t3kit/theme_t3kit/commit/80ce262))
- **[TASK]** add package-lock.json ([e0affbb](https://github.com/t3kit/theme_t3kit/commit/e0affbb))
- **[TASK]** update FE dependencies ([b51c809](https://github.com/t3kit/theme_t3kit/commit/b51c809))
- **[TASK]** update dependencies, sync composer.json with ext_emconf.php ([0296923](https://github.com/t3kit/theme_t3kit/commit/0296923))
- **[BUGFIX]** fix missing translate attribute for languageMenu_label (#396) ([f8b625d](https://github.com/t3kit/theme_t3kit/commit/f8b625d))

***

#### v2.5.0 `February 19, 2018`
- **[BUGFIX]** render title tag in news single view, fixes t3kit/t3kit#168 (#394) ([3d9cd51](https://github.com/t3kit/theme_t3kit/commit/3d9cd51))
- **[BUGFIX]** support enlarge on click for CE:s 'Images' and 'Image and text' (#388) ([28a1b50](https://github.com/t3kit/theme_t3kit/commit/28a1b50))
- **[TASK]** Change .inverse less-structure for easier inclusion as mixin. (#385) ([565f7fa](https://github.com/t3kit/theme_t3kit/commit/565f7fa))
- **[BUGFIX]** partly revert - improve news list accessibility (#343) ([ed1b624](https://github.com/t3kit/theme_t3kit/commit/ed1b624))
- **[BUGFIX]** revert - change markup for news list (#373) ([a4286d0](https://github.com/t3kit/theme_t3kit/commit/a4286d0))
- **[BUGFIX]** revert - set image width in news list (#379) ([61f117f](https://github.com/t3kit/theme_t3kit/commit/61f117f))
- **[BUGFIX]** revert - news extension list view: update no-image-markup (#380) ([288c495](https://github.com/t3kit/theme_t3kit/commit/288c495))
- **[BUGFIX]** revert commit - remove css for icon which is never visible (#374) ([bd63164](https://github.com/t3kit/theme_t3kit/commit/bd63164))
- **[BUGFIX]** revert PR adjust image height settings for news cards template (#382) ([b305f6a](https://github.com/t3kit/theme_t3kit/commit/b305f6a))
- **[BUGFIX]** revert PR Improve news cards accessibility (#351) ([2d33074](https://github.com/t3kit/theme_t3kit/commit/2d33074))
- **[BUGFIX]** fix the order of included TS files for gridelements (#368) ([c96b75b](https://github.com/t3kit/theme_t3kit/commit/c96b75b))
- **[BUGFIX]** revert news-carousel accessibility improvements (#352) ([f1b155e](https://github.com/t3kit/theme_t3kit/commit/f1b155e))
- **[BUGFIX]** adjust condition for carousel caption to not show up empty .carousel-caption container (#393) ([790748b](https://github.com/t3kit/theme_t3kit/commit/790748b))
- **[BUGFIX]** adjust NO path for current breadcrumb link (#389) ([468043f](https://github.com/t3kit/theme_t3kit/commit/468043f))
- **[BUGFIX]** remove empty <h> tags in slider caption (#387) ([5272b7a](https://github.com/t3kit/theme_t3kit/commit/5272b7a))
- **[BUGFIX]** adjust image height settings and css for news list templates (#384) ([f6c3a7c](https://github.com/t3kit/theme_t3kit/commit/f6c3a7c))
- **[BUGFIX]** adjust image height settings for news cards template (#382) ([8215842](https://github.com/t3kit/theme_t3kit/commit/8215842))
- **[BUGFIX]** remove unused gridelements frame_class (#383) ([0636112](https://github.com/t3kit/theme_t3kit/commit/0636112))
- **[BUGFIX]** News extension list view: update no-image-markup (#380) ([1af0474](https://github.com/t3kit/theme_t3kit/commit/1af0474))
- **[TASK]** Remove header tags from gridelements (#368) ([639608a](https://github.com/t3kit/theme_t3kit/commit/639608a))
- **[BUGFIX]** set image width in news list (#379) ([8b403e6](https://github.com/t3kit/theme_t3kit/commit/8b403e6))
- **[FEATURE]** Adds a skiplink to the TopContentMenuContent template (#372) ([48283c4](https://github.com/t3kit/theme_t3kit/commit/48283c4))
- **[BUGFIX]** change markup for news list (#373) ([b7f7bc7](https://github.com/t3kit/theme_t3kit/commit/b7f7bc7))
- **[BUGFIX]** Use percentage for top content carousel width (#376) ([c150ca8](https://github.com/t3kit/theme_t3kit/commit/c150ca8))
- **[BUGFIX]** remove css for icon which is never visible (#374) ([5c918ec](https://github.com/t3kit/theme_t3kit/commit/5c918ec))
- **[BUGFIX]** add missing contact tel in header template (#375) ([2a0432d](https://github.com/t3kit/theme_t3kit/commit/2a0432d))
- **[BUGFIX]** render content raw to avoid extra html tags (#371) ([222ffb2](https://github.com/t3kit/theme_t3kit/commit/222ffb2))
- **[TASK]** Update the version for frontend editing to be ''^1.3'' ([704cd25](https://github.com/t3kit/theme_t3kit/commit/704cd25))
- **[BUGFIX]** Fix frontend editing always shows is enabled in User settings (#370) ([caa9f74](https://github.com/t3kit/theme_t3kit/commit/caa9f74))
- **[FEATURE]** Allow tab navigation in carousel (#369) ([a1658f9](https://github.com/t3kit/theme_t3kit/commit/a1658f9))
- **[BUGFIX]** Add filetype to aria-label in news detail view (#367) ([010ef6a](https://github.com/t3kit/theme_t3kit/commit/010ef6a))
- **[TASK]** Add text color for focus state for main menu links (#365) ([b782f9c](https://github.com/t3kit/theme_t3kit/commit/b782f9c))
- **[BUGFIX]** remove css for icon which is never visible (#366) ([4b81734](https://github.com/t3kit/theme_t3kit/commit/4b81734))
- **[FEATURE]** add theme variables for button styles (#362) ([1c7ba14](https://github.com/t3kit/theme_t3kit/commit/1c7ba14))
- **[BUGFIX]** removed role attribute (#361) ([1697082](https://github.com/t3kit/theme_t3kit/commit/1697082))
- **[BUGFIX]** Hide icon of quote element for screenreaders (#364) ([0575a43](https://github.com/t3kit/theme_t3kit/commit/0575a43))
- **[TASK]** replace double slash in header JS code to avoid getting error in case when html is minified to one line. (#363) ([b2abcf7](https://github.com/t3kit/theme_t3kit/commit/b2abcf7))
- **[FEATURE]** improve news list accessibility (#343) ([0ef3f14](https://github.com/t3kit/theme_t3kit/commit/0ef3f14))
- **[BUGFIX]** render screen reader attributes in slider only if more then one image is inserted, change left and right arrow labels (#359) ([998fb94](https://github.com/t3kit/theme_t3kit/commit/998fb94))
- **[FEATURE]** Allow selection of headline type in accordion (#358) ([91976b2](https://github.com/t3kit/theme_t3kit/commit/91976b2))
- **[FEATURE]** Bootstrap slider: extend keyboard navigation (#356) ([7a3cf26](https://github.com/t3kit/theme_t3kit/commit/7a3cf26))
- **[TASK]** : add h2 heading to provide valid html structure (#342) ([8dc7a67](https://github.com/t3kit/theme_t3kit/commit/8dc7a67))
- **[FEATURE]** : add logoCarousel accessibility (#332) ([4b36c9b](https://github.com/t3kit/theme_t3kit/commit/4b36c9b))
- **[FEATURE]** add links to access main-nav and content directly (#321) ([299ca0b](https://github.com/t3kit/theme_t3kit/commit/299ca0b))
- **[FEATURE]** Add aria-attributes to social icons (#341) ([6257544](https://github.com/t3kit/theme_t3kit/commit/6257544))
- **[FEATURE]** more accessible news-carousel (#352) ([4c9b2aa](https://github.com/t3kit/theme_t3kit/commit/4c9b2aa))
- **[BUGFIX]** expand link of textpic element (#350) ([af0df2b](https://github.com/t3kit/theme_t3kit/commit/af0df2b))
- **[BUGFIX]** : update focus on quick links when keyboard navigation is used (#349) ([8516367](https://github.com/t3kit/theme_t3kit/commit/8516367))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[BUGFIX]** fix language files (#360) ([25c25bd](https://github.com/t3kit/theme_t3kit/commit/25c25bd))
- **[!!!]** **[BUGFIX]** Add missing configuration for shariff at news detail page (#348) ([c9a518e](https://github.com/t3kit/theme_t3kit/commit/c9a518e))

***

#### v2.4.0 `November 3, 2017`
- **[TASK]** add possibility to minify JS, add uglifyJs, fix #306 ([d683a53](https://github.com/t3kit/theme_t3kit/commit/d683a53))
- **[FEATURE]** Add Logo and language menu in navbar (#330) ([93d1f26](https://github.com/t3kit/theme_t3kit/commit/93d1f26))
- **[TASK]** Add aria-hidden attribute to image-text-link element (#338) ([c4138c4](https://github.com/t3kit/theme_t3kit/commit/c4138c4))
- **[BUGFIX]** Build links for accordion using Typolink (#335) ([62b6fa7](https://github.com/t3kit/theme_t3kit/commit/62b6fa7))
- **[TASK]** socialmedia, add new myNewsDesk icon (#333) ([a6172ee](https://github.com/t3kit/theme_t3kit/commit/a6172ee))
- **[TASK]** add aria tags to icon text and link element (#334) ([80fbed0](https://github.com/t3kit/theme_t3kit/commit/80fbed0))
- **[TASK]** add possibility to edit slider controls color (#331) ([d4fcfe8](https://github.com/t3kit/theme_t3kit/commit/d4fcfe8))
- **[TASK]** Add "nav"-html-tag around subnavigation for wai accessibility (#319) ([97e7083](https://github.com/t3kit/theme_t3kit/commit/97e7083))
- **[TASK]** contacts, add margin to link and icon (#326) ([72dcc32](https://github.com/t3kit/theme_t3kit/commit/72dcc32))
- **[TASK]** footer, add margin top for subpages (#327) ([f745916](https://github.com/t3kit/theme_t3kit/commit/f745916))
- **[TASK]** add data-caption for lightbox in news detail (#316) ([62ea836](https://github.com/t3kit/theme_t3kit/commit/62ea836))
- **[TASK]** remove fixed image dimensions in lightbox (#314) ([2a11e76](https://github.com/t3kit/theme_t3kit/commit/2a11e76))
- **[TASK]** use bootstrap variables in custom LESS files (#294) ([7a89a3d](https://github.com/t3kit/theme_t3kit/commit/7a89a3d))
- **[TASK]** remove condition with regexp and use .if for google analytics ts to improve performance (#322) ([f22465d](https://github.com/t3kit/theme_t3kit/commit/f22465d))
- **[FEATURE]** Google Tag Manager (#312) ([17859dc](https://github.com/t3kit/theme_t3kit/commit/17859dc))
- **[BUGFIX]** fixes exception thrown in CountViewHelper caused by Image partial in t3kit if metadata copyright was set (#325) ([1612b8b](https://github.com/t3kit/theme_t3kit/commit/1612b8b))
- **[FEATURE]** : enable keyboard and screen reader accessiblity on bootstrap carousel (#324) ([f79ec81](https://github.com/t3kit/theme_t3kit/commit/f79ec81))
- **[BUGFIX]** : set social icons alignment to right only in footer (#320) ([1fc8c04](https://github.com/t3kit/theme_t3kit/commit/1fc8c04))
- **[TASK]** remove outline styles set to none to have visible focus on elements (#318) ([603371c](https://github.com/t3kit/theme_t3kit/commit/603371c))
- **[TASK]** don't add classes 'btn btn-default' when link is 'whole area' in CE IconTextButton (#284) ([3ee4b3f](https://github.com/t3kit/theme_t3kit/commit/3ee4b3f))
- **[BUGFIX]** : remove redundant link in news cards (#308) ([db7b492](https://github.com/t3kit/theme_t3kit/commit/db7b492))
- **[TASK]** set default class '.table' for table content element (#315) ([c9f7653](https://github.com/t3kit/theme_t3kit/commit/c9f7653))
- **[TASK]** adjust mobile image display in bootstrap carousel (#313) ([fa77049](https://github.com/t3kit/theme_t3kit/commit/fa77049))
- **[BUGFIX]** : fix footer styles, fix #309 (#310) ([05ef44f](https://github.com/t3kit/theme_t3kit/commit/05ef44f))
- **[TASK]** adjust footer styles to use footer without special classes from BE (#303) ([b9fb0a4](https://github.com/t3kit/theme_t3kit/commit/b9fb0a4))
- **[BUGFIX]** fix missing dummy media if news item doesn't have any media (#302) ([6279b6f](https://github.com/t3kit/theme_t3kit/commit/6279b6f))
- **[BUGFIX]** : enable lightbox on news media, remove fluid viewhelper from source code (#300) ([637f96c](https://github.com/t3kit/theme_t3kit/commit/637f96c))
- **[TASK]** adjust news detail template (#283) ([5883dc7](https://github.com/t3kit/theme_t3kit/commit/5883dc7))
- **[TASK]** seperate responsive image typoscript for contact cards CE (#299) ([84ab333](https://github.com/t3kit/theme_t3kit/commit/84ab333))
- **[BUGFIX]** Remove header attribute from fluid_styled_content for valid w3c html (#292) ([2d8b11c](https://github.com/t3kit/theme_t3kit/commit/2d8b11c))
- **[TASK]** : add title for LogoCarousel images and link, add uri.image inline notation (#286) ([959617b](https://github.com/t3kit/theme_t3kit/commit/959617b))
- **[BUGFIX]** added missing configuration field for realurl speaking url. (#282) ([4b6641c](https://github.com/t3kit/theme_t3kit/commit/4b6641c))
- **[BUGFIX]** change span to div in news as cards and news as SimpleList to make html w3c valid (#288) ([19b428a](https://github.com/t3kit/theme_t3kit/commit/19b428a))
- **[TASK]** fix accessibility in TabGroup for valid w3c html (#289) ([cde4489](https://github.com/t3kit/theme_t3kit/commit/cde4489))
- **[TASK]** Update frontend_editing to version ''1.2.2'' (#291) ([0c2e680](https://github.com/t3kit/theme_t3kit/commit/0c2e680))
- **[FEATURE]** enable user-scalable for better accessibility (#295) ([15e988f](https://github.com/t3kit/theme_t3kit/commit/15e988f))
- **[BUGFIX]** enable multiple lightboxes on one page (#296) ([1c006d3](https://github.com/t3kit/theme_t3kit/commit/1c006d3))
- **[FEATURE]** Contact cards options (#297) ([12092f5](https://github.com/t3kit/theme_t3kit/commit/12092f5))
- **[TASK]** : enable full TYPO3 headers palette (#287) ([5d9c16a](https://github.com/t3kit/theme_t3kit/commit/5d9c16a))
- **[FEATURE]** tel link viewhelper ([fcf41fd](https://github.com/t3kit/theme_t3kit/commit/fcf41fd))
- **[TASK]** fix missing whitespace in Tabs for valid w3c html (#290) ([dd49800](https://github.com/t3kit/theme_t3kit/commit/dd49800))
- **[DOC]** update CHANGELOG ([ba0205b](https://github.com/t3kit/theme_t3kit/commit/ba0205b))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[TASK]** upgrade extension solr (#311) ([53c573b](https://github.com/t3kit/theme_t3kit/commit/53c573b))

***

#### v2.3.0 `September 14, 2017`
- **[TASK]** update default groupid for new pages (#262) ([27c7582](https://github.com/t3kit/theme_t3kit/commit/27c7582))
- **[TASK]** added new Norwegian special character to realurl utility (#281) ([e3eb413](https://github.com/t3kit/theme_t3kit/commit/e3eb413))
- **[TASK]** remove fixed label "tel:" from Header template (#280) ([ac080fe](https://github.com/t3kit/theme_t3kit/commit/ac080fe))
- **[DOC]** update README, move t3kit 7 info to the bottom ([7c931eb](https://github.com/t3kit/theme_t3kit/commit/7c931eb))
- **[TASK]** update travis config ([4ff474c](https://github.com/t3kit/theme_t3kit/commit/4ff474c))
- **[TASK]** update felayout dependencies ([8aebf1c](https://github.com/t3kit/theme_t3kit/commit/8aebf1c))
- **[FEATURE]** add an option to use the Title from the first slide as main header of the page in the CE Slider (#275) ([f1db53d](https://github.com/t3kit/theme_t3kit/commit/f1db53d))
- **[TASK]** update news ext. in ext_emconf.php ([9723f51](https://github.com/t3kit/theme_t3kit/commit/9723f51))
- **[BUGFIX]** output image alt text from media in ImageTextLink CE:s (#274) ([0ac71e2](https://github.com/t3kit/theme_t3kit/commit/0ac71e2))
- **[TASK]** update extension news to 6.1.x (#273) ([2ba3252](https://github.com/t3kit/theme_t3kit/commit/2ba3252))
- **[FEATURE]** display Themes 'Development Mode' setting in system informa… (#272) ([670444e](https://github.com/t3kit/theme_t3kit/commit/670444e))
- **[TASK]** synchronize extension dependencies between composer.json and ext_emconf.php ([5d3f64d](https://github.com/t3kit/theme_t3kit/commit/5d3f64d))
- **[TASK]** update composer dependencies ([310d31f](https://github.com/t3kit/theme_t3kit/commit/310d31f))
- **[FEATURE]** Upgrade Bootstrap Slider element. (#269) ([ec026d4](https://github.com/t3kit/theme_t3kit/commit/ec026d4))
- **[TASK]** Update ''frontend_editing'' to version 1.2.0 (#271) ([ba5105d](https://github.com/t3kit/theme_t3kit/commit/ba5105d))
- **[TASK]** set version of themes extension (#270) ([6add041](https://github.com/t3kit/theme_t3kit/commit/6add041))
- **[FEATURE]** Add rx_shariff option in news detail template. (#260) ([57cb425](https://github.com/t3kit/theme_t3kit/commit/57cb425))
- **[FEATURE]** add XING social icon (#268) ([d439405](https://github.com/t3kit/theme_t3kit/commit/d439405))
- **[FEATURE]** add new content element Contacts Card (#253) ([53e5546](https://github.com/t3kit/theme_t3kit/commit/53e5546))
- **[BUGFIX]** Add position absolute for preview image in news simple list. (#257) ([f364e3b](https://github.com/t3kit/theme_t3kit/commit/f364e3b))
- **[BUGFIX]** make long menu entries always fit in the navigation dropdown (#265) ([f22fb9d](https://github.com/t3kit/theme_t3kit/commit/f22fb9d))
- **[TASK]** Update frontend_editing to be ''1.1.3'' ([c9b54e0](https://github.com/t3kit/theme_t3kit/commit/c9b54e0))
- **[TASK]** update extensions: realurl 2.2.0 -> 2.2.1, go_maps_ext 2.2.0 -> 2.3.0, cs_seo 2.0.1 -> 2.1.2 and realurl-404-multilingual master -> 1.0.9 (#264) ([e6ec515](https://github.com/t3kit/theme_t3kit/commit/e6ec515))
- **[BUGFIX]** change package name for realurl-404-multilingual (#263) ([c35575b](https://github.com/t3kit/theme_t3kit/commit/c35575b))
- **[BUGFIX]** text and media, fixed image appearance (#258) ([8abc64c](https://github.com/t3kit/theme_t3kit/commit/8abc64c))
- **[TASK]** Update to use version ''1.1.2'' of frontend_editing ([d81a4c7](https://github.com/t3kit/theme_t3kit/commit/d81a4c7))
- **[FEATURE]** Add google site verification meta tag. (#256) ([dc4d4ec](https://github.com/t3kit/theme_t3kit/commit/dc4d4ec))
- **[BUGFIX]** allow "fixedPostVarsSaveFilePath" outside directory "typo3conf" (#259) ([9886326](https://github.com/t3kit/theme_t3kit/commit/9886326))
- **[BUGFIX]** add TCA overrides for cs_seo only if extension is loaded. (#254) ([d155466](https://github.com/t3kit/theme_t3kit/commit/d155466))
- **[TASK]** Update to use version 1.1.1 from frontend_editing ([1526ca5](https://github.com/t3kit/theme_t3kit/commit/1526ca5))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[BUGFIX]** use NoBgImage layout for content elements based on gridelements ext. except grids (#278) ([8b950c6](https://github.com/t3kit/theme_t3kit/commit/8b950c6))

***

#### v2.2.3 `September 11, 2017`
- **[BUGFIX]** set version of themes extension ([297d5e5](https://github.com/t3kit/theme_t3kit/commit/297d5e5))

***

#### v2.2.2 `September 8, 2017`
- **[BUGFIX]** change package name for realurl-404-multilingual ([9f1f7f1](https://github.com/t3kit/theme_t3kit/commit/9f1f7f1))

***

#### v2.2.1 `July 4, 2017`
- **[BUGFIX]** decrease view (1700 to 400) priority in ext:theme template, fix #244 ([701bbc8](https://github.com/t3kit/theme_t3kit/commit/701bbc8))
- **[BUGFIX]** news simple list, fix image scaling (#243) ([47a4f42](https://github.com/t3kit/theme_t3kit/commit/47a4f42))
- **[FEATURE]** Add dropdown at login page for redirecting to backend or frontend (#251) ([28a32e0](https://github.com/t3kit/theme_t3kit/commit/28a32e0))
- **[BUGFIX]** fix 'white screen' in frontend for TYPO3 8.7.2, resolves #249 (#250) ([140b350](https://github.com/t3kit/theme_t3kit/commit/140b350))
- **[BUGFIX]** news item, add class to make image responsive #190 (#242) ([7988d4e](https://github.com/t3kit/theme_t3kit/commit/7988d4e))

***

#### v2.2.0 `June 9, 2017`
- **[FEATURE]** add option to align navbar menu links to the right (#241) ([13e41c1](https://github.com/t3kit/theme_t3kit/commit/13e41c1))
- **[FEATURE]** add language dropdown label (#238) ([e7751e5](https://github.com/t3kit/theme_t3kit/commit/e7751e5))
- **[TASK]** Slider Container, add option to control arrows position (#240) ([b38183a](https://github.com/t3kit/theme_t3kit/commit/b38183a))
- **[TASK]** update pxa-newsletter-subscription to v 5.0.2 ([504f7f7](https://github.com/t3kit/theme_t3kit/commit/504f7f7))
- **[TASK]** Update extension ''frontend_editing'' to version 1.0.9 (#235) ([b17fde0](https://github.com/t3kit/theme_t3kit/commit/b17fde0))
- **[TASK]** Slider Container, add option to control pagination position (#222) ([7fdaede](https://github.com/t3kit/theme_t3kit/commit/7fdaede))
- **[BUGFIX]** show only one heroImage in SliderContainer when page is loading (#237) ([e4cf7fb](https://github.com/t3kit/theme_t3kit/commit/e4cf7fb))
- **[BUGFIX]** imageTextLink, fix mobile view (#221) ([e8e9df5](https://github.com/t3kit/theme_t3kit/commit/e8e9df5))
- **[BUGFIX]** slider container, fix flip animation (#233) ([940a610](https://github.com/t3kit/theme_t3kit/commit/940a610))
- **[BUGFIX]** imageTextLink, fix mobile view for hover_4 effect (#234) ([1e5d0b0](https://github.com/t3kit/theme_t3kit/commit/1e5d0b0))
- **[BUGFIX]** move iconFontSelector.css from auto generated css folder ([7f03d91](https://github.com/t3kit/theme_t3kit/commit/7f03d91))
- **[BUGFIX]** Navbar dropdown with two rows + social icons hover color, fix #224, fix #225 (#232) ([b0bb730](https://github.com/t3kit/theme_t3kit/commit/b0bb730))
- **[BUGFIX]** force jquery to be included first; otherwise there could be errors from 3rd party extensions which includes theirs scripst before it (#218) ([36567ff](https://github.com/t3kit/theme_t3kit/commit/36567ff))
- **[FIX]** fix google map configuration label (#227) ([bcaea37](https://github.com/t3kit/theme_t3kit/commit/bcaea37))

***

#### v2.1.1 `May 18, 2017`
- **[BUGFIX]** prevent sql error when creating new page in page tree. (#217) ([e1afa6c](https://github.com/t3kit/theme_t3kit/commit/e1afa6c))
- **[DOC]** update README, remove beta tag ([406a4c7](https://github.com/t3kit/theme_t3kit/commit/406a4c7))

***

#### v2.1.0 `May 17, 2017`
- **[BUGFIX]** hero Image, fix css selector (#216) ([9e5dcf5](https://github.com/t3kit/theme_t3kit/commit/9e5dcf5))
- **[FEATURE]** add responsive bg images into gridelements and HeroImage ([19cc05d](https://github.com/t3kit/theme_t3kit/commit/19cc05d))
- **[BUGFIX]** Slider Container fix top and bottom margins (#214) ([8a23016](https://github.com/t3kit/theme_t3kit/commit/8a23016))
- **[TASK]** update frontend_editing to version 1.0.8 (#213) ([56033af](https://github.com/t3kit/theme_t3kit/commit/56033af))
- **[TASK]** update csh id:s (#212) ([3df15df](https://github.com/t3kit/theme_t3kit/commit/3df15df))
- **[BUGFIX]** Hero Image mobile view, button hover and active state (#207) ([333c65d](https://github.com/t3kit/theme_t3kit/commit/333c65d))
- **[FEATURE]** responsive background images for parallax element (#211) ([4782fa9](https://github.com/t3kit/theme_t3kit/commit/4782fa9))
- **[TASK]** cleanup and update locallang language labels (#205) ([fdbaebf](https://github.com/t3kit/theme_t3kit/commit/fdbaebf))
- **[TASK]** cleanup and update language labels for BElayouts (#204) ([fddf456](https://github.com/t3kit/theme_t3kit/commit/fddf456))
- **[TASK]** install frontend-editing from typo3-ter ([4c0fec4](https://github.com/t3kit/theme_t3kit/commit/4c0fec4))
- **[BUGFIX]** Fetch pageTS from current page and not parent page (#206) ([d1bda64](https://github.com/t3kit/theme_t3kit/commit/d1bda64))
- **[TASK]** cleanup and update language labels for content elements ([0cf7efb](https://github.com/t3kit/theme_t3kit/commit/0cf7efb))
- **[TASK]** cleanup and update language labels for gridelements ([eaeac4a](https://github.com/t3kit/theme_t3kit/commit/eaeac4a))
- **[FEATURE]** Hero Image, add semitransparent overlay (#197) ([bec9812](https://github.com/t3kit/theme_t3kit/commit/bec9812))
- **[BUGFIX]** Hero Image, fix button background and size (#199) ([d31a05c](https://github.com/t3kit/theme_t3kit/commit/d31a05c))
- **[BUGFIX]** Hero Image inside slider container, fix pagination and margins (#198) ([2300e34](https://github.com/t3kit/theme_t3kit/commit/2300e34))
- **[TASK]** add appearanceTab as the main folder for wrappers styling ([ee9aa33](https://github.com/t3kit/theme_t3kit/commit/ee9aa33))
- **[FEATURE]** Hero Image, new animation styles (#195) ([2631abb](https://github.com/t3kit/theme_t3kit/commit/2631abb))
- **[FEATURE]** Hero Image, add option for vertical alignment (#194) ([4ce7556](https://github.com/t3kit/theme_t3kit/commit/4ce7556))
- **[BUGFIX]** fix felayout conf to work with subpages ([33389a6](https://github.com/t3kit/theme_t3kit/commit/33389a6))
- **[DOC]** update README ([baaa225](https://github.com/t3kit/theme_t3kit/commit/baaa225))
- **[DOC]** update README for felayout ([d7f263a](https://github.com/t3kit/theme_t3kit/commit/d7f263a))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** ** Replace extension seo_basics with cs_seo (#209)**  ([a8fcc37](https://github.com/t3kit/theme_t3kit/commit/a8fcc37))
- **[!!!]** **[TASK]** change how fullWidthImage img is rendered (#201) ([d1f953c](https://github.com/t3kit/theme_t3kit/commit/d1f953c))
- **[!!!]** **[TASK]** update Appearance and Layout wrapper labels/classes, make it more semantic ([b9103e1](https://github.com/t3kit/theme_t3kit/commit/b9103e1))

***

#### v2.0.0 `May 3, 2017`
- **[FEATURE]** make some of the Favicons typoscript use constants (#188) ([28e8683](https://github.com/t3kit/theme_t3kit/commit/28e8683))
- **[TASK]** add all FE dependencies using NPM instead of Bower ([85dcca6](https://github.com/t3kit/theme_t3kit/commit/85dcca6))
- **[TASK]** add cookie-bar and form-enhancement ext. from typo3-ter ([2c0e4f9](https://github.com/t3kit/theme_t3kit/commit/2c0e4f9))
- **[TASK]** update css/less syntax according to stylelint (#184) ([7405ee1](https://github.com/t3kit/theme_t3kit/commit/7405ee1))
- **[TASK]** cleanup + code style fixes (.editorconfig) ([9cc29fd](https://github.com/t3kit/theme_t3kit/commit/9cc29fd))
- **[TASK]** add stylelint to grunt check ([483747c](https://github.com/t3kit/theme_t3kit/commit/483747c))
- **[TASK]** remove mailForm.less ([efd6bc8](https://github.com/t3kit/theme_t3kit/commit/efd6bc8))
- **[DOC]** fix REDAME for iconFonts ([19226bc](https://github.com/t3kit/theme_t3kit/commit/19226bc))
- **[TASK]** remove unneeded styling ([b5ae29c](https://github.com/t3kit/theme_t3kit/commit/b5ae29c))
- **[TASK]** update pxa_newsletter_subscription to v4.1.2 (#183) ([da9785e](https://github.com/t3kit/theme_t3kit/commit/da9785e))
- **[BUGFIX]** only enable lib.xxx.search as userFunc if enableSolr is 1 (#182) ([baae04a](https://github.com/t3kit/theme_t3kit/commit/baae04a))
- **[TASK]** add filemount filedamin/forms to TYPO3 Form (#172) ([d8c1d61](https://github.com/t3kit/theme_t3kit/commit/d8c1d61))
- **[TASK]** remove csslint and add stylelint to felayout_t3kit ([3924cb5](https://github.com/t3kit/theme_t3kit/commit/3924cb5))
- **[FIX]** delete unneeded selector in footer, edit according to stylint (#171) ([a4c4abc](https://github.com/t3kit/theme_t3kit/commit/a4c4abc))
- **[TASK]** add mixins.less, update iconFont styling ([72d2cd7](https://github.com/t3kit/theme_t3kit/commit/72d2cd7))
- **[FIX]** remove gridelements from migration script, still uses media field (#169) ([46e6c04](https://github.com/t3kit/theme_t3kit/commit/46e6c04))
- **[TASK]** migrate media to assets for some theme CE:s, fix in twbsButton script (#168) ([41bee7b](https://github.com/t3kit/theme_t3kit/commit/41bee7b))
- **[FIX]** Collapsible, remove section in template and fix section name in layout Empty (#167) ([c1e65ef](https://github.com/t3kit/theme_t3kit/commit/c1e65ef))
- **[FIX]** update default constant of logo filename (#165) ([e401a75](https://github.com/t3kit/theme_t3kit/commit/e401a75))
- **[TASK]** migration queries (#166) ([3dc2177](https://github.com/t3kit/theme_t3kit/commit/3dc2177))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[TASK]** use NPM instead of Bower as a main FE package manager ([9962486](https://github.com/t3kit/theme_t3kit/commit/9962486))
- **[!!!]** **[TASK]** removed felogin constants (redirects), added new constant.. (#170) ([2496a26](https://github.com/t3kit/theme_t3kit/commit/2496a26))

***

#### v2.0.0-beta.1 `April 21, 2017`
- **[TASK]** add buttonStyle for Button content el. ([050ae58](https://github.com/t3kit/theme_t3kit/commit/050ae58))
- **[TASK]** add all needed dependencies for theme_t3kit ([bc4bdf9](https://github.com/t3kit/theme_t3kit/commit/bc4bdf9))
- **[FIX]** move column definitions to flexform from pagets (#164) ([b7671bc](https://github.com/t3kit/theme_t3kit/commit/b7671bc))
- **[TASK]** set lightboxEnabled to enabled by default, custom ts and Image… (#157) ([578013c](https://github.com/t3kit/theme_t3kit/commit/578013c))
- **[TASK]** restore fixedPostVarsSaveFilePath filename (#163) ([6f6ee6e](https://github.com/t3kit/theme_t3kit/commit/6f6ee6e))
- **[TASK]** create bigger icons for content elements ([ae5fcc4](https://github.com/t3kit/theme_t3kit/commit/ae5fcc4))
- **[FIX]** fix and update IconFonts configuration ([a2b977a](https://github.com/t3kit/theme_t3kit/commit/a2b977a))
- **[TASK]** update css/less files ([211ed2e](https://github.com/t3kit/theme_t3kit/commit/211ed2e))
- **[TASK]** add Gridelements layouts ([a718399](https://github.com/t3kit/theme_t3kit/commit/a718399))
- **[TASK]** add new fonts Roboto/Crimson ([bac846d](https://github.com/t3kit/theme_t3kit/commit/bac846d))
- **[FIX]** Button content element layout ([ce5bd77](https://github.com/t3kit/theme_t3kit/commit/ce5bd77))
- **[TASK]** add possibility to change Header partial ([a9bbe21](https://github.com/t3kit/theme_t3kit/commit/a9bbe21))
- **[TASK]** update theme description and screenshot ([d95621a](https://github.com/t3kit/theme_t3kit/commit/d95621a))
- **[FIX]** change selector for icons font (#162) ([32770db](https://github.com/t3kit/theme_t3kit/commit/32770db))
- **[TASK]** remove form customizations for older TYPO3 versions (#161) ([78a115f](https://github.com/t3kit/theme_t3kit/commit/78a115f))
- **[TASK]** modify and reorder Theme constants ([1016a2d](https://github.com/t3kit/theme_t3kit/commit/1016a2d))
- **[FIX]** ImageTextLink and ResponsiveVideo CE:s now use assets field instead of media field (#160) ([58acdae](https://github.com/t3kit/theme_t3kit/commit/58acdae))
- **[TASK]** add Realurl replace characters xclass (#159) ([051b365](https://github.com/t3kit/theme_t3kit/commit/051b365))
- **[FIX]** get preview of media in ImageTextLink content elements (#158) ([72eefb1](https://github.com/t3kit/theme_t3kit/commit/72eefb1))
- **[FIX]** use labels from correct extension and add missing css in IconFontSelector (#156) ([1ed79af](https://github.com/t3kit/theme_t3kit/commit/1ed79af))
- **[TASK]** Remove t3kit_extension_tools  from language menu (#155) ([0800606](https://github.com/t3kit/theme_t3kit/commit/0800606))
- **[TASK]** add conf for CKEditor, remove Rtehtmlarea ([6c9611d](https://github.com/t3kit/theme_t3kit/commit/6c9611d))
- **[TASK]** add option to select a fixedPostVars configuration on page records (#151) ([0478d23](https://github.com/t3kit/theme_t3kit/commit/0478d23))
- **[TASK]** modify logo and feLayoutPath Theme constants ([2724783](https://github.com/t3kit/theme_t3kit/commit/2724783))
- **[TASK]** add new content element/gridelements icons ([432e194](https://github.com/t3kit/theme_t3kit/commit/432e194))
- **[TASK]** new default layout for GridElements, update pagets for GridElements ([a445592](https://github.com/t3kit/theme_t3kit/commit/a445592))
- **[FIX]** fix typo in FluidStyledContent layout defaultr -> default ([34033bf](https://github.com/t3kit/theme_t3kit/commit/34033bf))
- **[TASK]** update/fix GridElements templates and TS ([489a718](https://github.com/t3kit/theme_t3kit/commit/489a718))
- **[TASK]** update includeCSS and includeJS TS conf ([e99d657](https://github.com/t3kit/theme_t3kit/commit/e99d657))
- **[TASK]** migrate lib.fluidContent -> lib.contentElement (t3kit content elements) ([c2a34b2](https://github.com/t3kit/theme_t3kit/commit/c2a34b2))
- **[TASK]** fix and update Typical Page Content in t3kit ([00ccd1c](https://github.com/t3kit/theme_t3kit/commit/00ccd1c))
- **[TASK]** felayout -> fix clean task, update browserSync conf ([845302c](https://github.com/t3kit/theme_t3kit/commit/845302c))
- **[DOC]** add README to Resources/Public with explanation of css/less folder ([64136fc](https://github.com/t3kit/theme_t3kit/commit/64136fc))
- **[TASK]** compile felayout to css/less folder ([ae5a7f3](https://github.com/t3kit/theme_t3kit/commit/ae5a7f3))
- **[TASK]** add felayout_t3kit to the root of theme ([d8261ba](https://github.com/t3kit/theme_t3kit/commit/d8261ba))
- **[TASK]** remove felayout_t3kit from Resources/Public ([bc601e2](https://github.com/t3kit/theme_t3kit/commit/bc601e2))
- **[TASK]** update/reorder/prettify backend fields of content elements ([2face97](https://github.com/t3kit/theme_t3kit/commit/2face97))
- **[TASK]** add condition to check if frame_class != default ([1d81b8f](https://github.com/t3kit/theme_t3kit/commit/1d81b8f))
- **[TASK]** general typoscript cleanup and upgrade ([91243ef](https://github.com/t3kit/theme_t3kit/commit/91243ef))
- **[TASK]** modify content elements pagets ([f684837](https://github.com/t3kit/theme_t3kit/commit/f684837))
- **[TASK]** modify content elements setupts (lib.fluidContent -> lib.contentElement) ([21b2d17](https://github.com/t3kit/theme_t3kit/commit/21b2d17))
- **[TASK]** add empty Header section to omit its rendering in t3kit content el. ([dfc8e36](https://github.com/t3kit/theme_t3kit/commit/dfc8e36))
- **[TASK]** remove Tabs and Accordion templates ([729ab5e](https://github.com/t3kit/theme_t3kit/commit/729ab5e))
- **[TASK]** use Default layout in content elements ([5f32779](https://github.com/t3kit/theme_t3kit/commit/5f32779))
- **[TASK]** add svg viewhelper to theme_t3kit and register t3kit fluid nam… (#150) ([ab51a44](https://github.com/t3kit/theme_t3kit/commit/ab51a44))
- **[TASK]** add FlexFormProcessor and LayoutClassProcessor to theme_t3kit and use them instead of the ones in t3kit_extension_tools (#149) ([09efe57](https://github.com/t3kit/theme_t3kit/commit/09efe57))
- **[TASK]** will change solr host to t3kit_solr in 'Development/Docker' context (#147) ([6b7e867](https://github.com/t3kit/theme_t3kit/commit/6b7e867))
- **[TASK]** Set config.sendCacheHeaders to 1 (see #145) (#146) ([3ae2555](https://github.com/t3kit/theme_t3kit/commit/3ae2555))
- **[TASK]** delete copyToRoot templates and local folders ([7e1e562](https://github.com/t3kit/theme_t3kit/commit/7e1e562))
- **[TASK]** add standardjs config ([9cc4841](https://github.com/t3kit/theme_t3kit/commit/9cc4841))
- **[TASK]** update favicons config ([0c65669](https://github.com/t3kit/theme_t3kit/commit/0c65669))
- **[TASK]** add css and less folders with js and css for theme_t3kit ([b664246](https://github.com/t3kit/theme_t3kit/commit/b664246))
- **[TASK]** add felayout_t3kit into theme_t3kit ([5ac1b1f](https://github.com/t3kit/theme_t3kit/commit/5ac1b1f))
- **[TASK]** add Development mode for felayout ([a469dfa](https://github.com/t3kit/theme_t3kit/commit/a469dfa))
- **[TASK]** added icons for meta menu inside mobile menu (#143) ([c277d90](https://github.com/t3kit/theme_t3kit/commit/c277d90))
- **[FEATURE]** make it possible to add meta menu to main mobile menu (#142) ([99d77b2](https://github.com/t3kit/theme_t3kit/commit/99d77b2))
- **[TASK]** remove felayout submodule ([c53ce91](https://github.com/t3kit/theme_t3kit/commit/c53ce91))
- **[TASK]** remove guide ext. config ([e3612bf](https://github.com/t3kit/theme_t3kit/commit/e3612bf))
- **[TASK]** remove custom content elements ([dbca436](https://github.com/t3kit/theme_t3kit/commit/dbca436))
- **[TASK]** add new content element - Button ([4e079fa](https://github.com/t3kit/theme_t3kit/commit/4e079fa))
- **[BUGFIX]** wrong condition for wrapper classes in layouts ([e9f8026](https://github.com/t3kit/theme_t3kit/commit/e9f8026))
- **[BUGFIX]** broken palette ([d7076e4](https://github.com/t3kit/theme_t3kit/commit/d7076e4))
- **[TASK]** removed deprecated labels ([dc1bbf8](https://github.com/t3kit/theme_t3kit/commit/dc1bbf8))
- **[BUGFIX]** broken icons of grid elements in typo 8.5 ([655fe15](https://github.com/t3kit/theme_t3kit/commit/655fe15))
- **[FIX]** correct using of condition in typo3 8.5 new way ([0248663](https://github.com/t3kit/theme_t3kit/commit/0248663))
- **[FIX]** put additional classes in one variable for correct condition check ([a4e83eb](https://github.com/t3kit/theme_t3kit/commit/a4e83eb))
- **[TASK]** icons for new vertical text options ([a3ad3d8](https://github.com/t3kit/theme_t3kit/commit/a3ad3d8))
- **[TASK]** image + vertical aligned text ([e156092](https://github.com/t3kit/theme_t3kit/commit/e156092))
- **[BUGFIX]** inline image in advance grid ([e44e725](https://github.com/t3kit/theme_t3kit/commit/e44e725))
- **[BUGFIX]** carousel image alias fix ([cd7f66a](https://github.com/t3kit/theme_t3kit/commit/cd7f66a))
- **[BUGFIX]** defaultCase for MediaGallery partial fix ([9d8a75c](https://github.com/t3kit/theme_t3kit/commit/9d8a75c))
- **[TASK]** fixed condition string ([6151315](https://github.com/t3kit/theme_t3kit/commit/6151315))
- **[BUGFIX]** Replace space character in telephone number of href to have valid HTML. (#137) ([a7d9541](https://github.com/t3kit/theme_t3kit/commit/a7d9541))
- **[FIX]** display media items in custom element ImageTextLink (#136) ([a2cbd2a](https://github.com/t3kit/theme_t3kit/commit/a2cbd2a))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[TASK]** remove unneeded FluidStyledContent layouts ([f64aebe](https://github.com/t3kit/theme_t3kit/commit/f64aebe))
- **[!!!]** **[TASK]** remove Custom Content Elements ts ([1356b91](https://github.com/t3kit/theme_t3kit/commit/1356b91))
- **[!!!]** **[TASK]** relocate IconFonts from felayout to Resources/Public/IconFonts folder ([327fdbb](https://github.com/t3kit/theme_t3kit/commit/327fdbb))
- **[!!!]** **[TASK]** Remove t3kit_extension_tools  reference (#154) ([9929947](https://github.com/t3kit/theme_t3kit/commit/9929947))
- **[!!!]** **[TASK]** remove tabs content el. remove wrapper, margin_top and margin_bottom selectors ([d75852d](https://github.com/t3kit/theme_t3kit/commit/d75852d))
- **[!!!]** **[TASK]** add userFunc IconFontSelector to theme_t3kit from t3kit_extension_tools (#148) ([2c208be](https://github.com/t3kit/theme_t3kit/commit/2c208be))

***

#### v1.10.1 `February 21, 2017`
- **[BUGFIX]** set correct dependency range for t3kit_extension_tools ([d2b9125](https://github.com/t3kit/theme_t3kit/commit/d2b9125))

***

#### v1.10.0 `February 20, 2017`
- **[UPDATE]** felayout_t3kit, add styles for new content element Hero Image ([f474a88](https://github.com/t3kit/theme_t3kit/commit/f474a88))
- **[TASK]** remuve media from heroImage element ([4d5333b](https://github.com/t3kit/theme_t3kit/commit/4d5333b))
- **[FEATURE]** add new content element Hero Image (#132) ([1867f5a](https://github.com/t3kit/theme_t3kit/commit/1867f5a))
- **[TASK]** improve guide ThemeModule, add more step, change pageTS folder ([0936b61](https://github.com/t3kit/theme_t3kit/commit/0936b61))
- **[FIX]** solr docker configuration (Podio bug_36) (#129) ([e648c8e](https://github.com/t3kit/theme_t3kit/commit/e648c8e))
- **[TASK]** cleanup news templates (News ext v5.3.2) ([1e2cc3b](https://github.com/t3kit/theme_t3kit/commit/1e2cc3b))
- **[FIX]** use fluid htmlentitiesDecode in News (#133) ([04919f5](https://github.com/t3kit/theme_t3kit/commit/04919f5))
- **[UPDATE]** php dependency to allow PHP 7.1 ([c3c1628](https://github.com/t3kit/theme_t3kit/commit/c3c1628))
- **[TASK]** hide unneeded config from Themes ext ([6dcced2](https://github.com/t3kit/theme_t3kit/commit/6dcced2))
- **[UPDATE]** required dependencies config ([70ab20a](https://github.com/t3kit/theme_t3kit/commit/70ab20a))
- **[FEATURE]** Social Icons Urls editable on different languages (Podio feature_40) (#119) ([0cb8275](https://github.com/t3kit/theme_t3kit/commit/0cb8275))
- **[BUGFIX]** added missing closing tags for dropdown menu (#125) ([d345c53](https://github.com/t3kit/theme_t3kit/commit/d345c53))
- **[FEATURE]** Create and fix TypoScript for use guide ext (#130) ([5d1690c](https://github.com/t3kit/theme_t3kit/commit/5d1690c))
- **[FEATURE]** add news teaser to solr search (#117) ([18af03a](https://github.com/t3kit/theme_t3kit/commit/18af03a))

***

#### v1.9.0 `January 24, 2017`
- **[UPDATE]** felayout_t3kit 1.7.0 ([f7f6f6b](https://github.com/t3kit/theme_t3kit/commit/f7f6f6b))
- **[UPDATE]** felayout_t3kit, add 6-7 levels for submenu and fix news pagination and tags ([fc44101](https://github.com/t3kit/theme_t3kit/commit/fc44101))
- **[FEATURE]** add possibility to change link text, and appearance for each slide (Podio feature_54) (#114) ([476eb90](https://github.com/t3kit/theme_t3kit/commit/476eb90))
- **[FEATURE]** Added 6-7 levels for submenu (Podio feature_28) (#113) ([dadc067](https://github.com/t3kit/theme_t3kit/commit/dadc067))
- **[UPDATE]** felayout_t3kit, Add third menu-level for main navigation ([9c27537](https://github.com/t3kit/theme_t3kit/commit/9c27537))
- **[TASK]** third menu-level disabled by default ([b954aa4](https://github.com/t3kit/theme_t3kit/commit/b954aa4))
- **[FEATURE]** Add third menu-level for main navigation. This is an optional output that can be triggered via additional variable. (#107) ([ab8ee1a](https://github.com/t3kit/theme_t3kit/commit/ab8ee1a))
- **[UPDATE]** felayout_t3kit, Simple accordion (Podio feature_34) ([3c32028](https://github.com/t3kit/theme_t3kit/commit/3c32028))
- **[FEATURE]** add new element Simple accordion (Podio feature_34) (#112) ([40b89ab](https://github.com/t3kit/theme_t3kit/commit/40b89ab))
- **[UPDATE]** felayout_t3kit, add styles for customizing search-text (Podio feature_32) ([0707544](https://github.com/t3kit/theme_t3kit/commit/0707544))
- **[TASK]** remove default less constants logoTop logoLeft and logoWidth, fix #108 ([6fbf04a](https://github.com/t3kit/theme_t3kit/commit/6fbf04a))
- **[FEATURE]** changed default news dummyImage to the new one (Podio feature_60) (#110) ([46b519e](https://github.com/t3kit/theme_t3kit/commit/46b519e))
- **[FEATURE]** add settings for search placeholder/text color (Podio feature_32) (#106) ([a3b32a7](https://github.com/t3kit/theme_t3kit/commit/a3b32a7))
- **[UPDATE]** felayout_t3kit, add styles for responsive video (Podio bug_60), add text aligning for Slider (Podio feature_63) ([8c437c6](https://github.com/t3kit/theme_t3kit/commit/8c437c6))
- **[FEATURE]** add alignment settings to slider element (Podio feature_63) (#102) ([8ba252c](https://github.com/t3kit/theme_t3kit/commit/8ba252c))
- **[FIX]** Correct typo in header comment (#103) ([580e01b](https://github.com/t3kit/theme_t3kit/commit/580e01b))
- **[TASK]** Add Google map API key into Theme constants ([14d1ef0](https://github.com/t3kit/theme_t3kit/commit/14d1ef0))
- **[FEATURE]** Change Login label to Logout, when a user logged. (Podio feature_5) (#79) ([15b7d57](https://github.com/t3kit/theme_t3kit/commit/15b7d57))
- **[UPDATE]** felayout_t3kit, add CSS styles for hover effects ([72a1f1c](https://github.com/t3kit/theme_t3kit/commit/72a1f1c))
- **[FEATURE]** imageTextLink, add 9 hover effects (animatons) ([11d30ac](https://github.com/t3kit/theme_t3kit/commit/11d30ac))
- **[UPDATE]** felayout_t3kit, fix main menu orientationchange event (Podio bug_25) ([3944981](https://github.com/t3kit/theme_t3kit/commit/3944981))
- **[UPDATE]** felayout_t3kit fix wholeAreaLink css styles and validations errors ([5fb35f0](https://github.com/t3kit/theme_t3kit/commit/5fb35f0))
- **[FIX]** newsCarousel, fix validation issue (<p> inside of <span> tag) (#100) ([1c29f49](https://github.com/t3kit/theme_t3kit/commit/1c29f49))
- **[FEATURE]** bootstrap slider Crop Images (#97) ([d40ffd9](https://github.com/t3kit/theme_t3kit/commit/d40ffd9))
- **[FIX]** wholeAreaLink, fix template, change settings titles (#98) ([6836755](https://github.com/t3kit/theme_t3kit/commit/6836755))
- **[FIX]** header logo alignment (Podio bug_32) (#92) ([23dce9a](https://github.com/t3kit/theme_t3kit/commit/23dce9a))
- **[FIX]** fix w3c validation of LogoCarousel (Podio bug_30) (#94) ([eeed317](https://github.com/t3kit/theme_t3kit/commit/eeed317))
- **[FEATURE]** fr translation for grid_element content (#96) ([4a97f88](https://github.com/t3kit/theme_t3kit/commit/4a97f88))
- **[FIX]** Another prefix for extension tools ([c0f50a5](https://github.com/t3kit/theme_t3kit/commit/c0f50a5))
- **[FIX]** Add minimum stability flag ([a96021a](https://github.com/t3kit/theme_t3kit/commit/a96021a))
- **[FIX]** Remove additional comma ([4c0e5ec](https://github.com/t3kit/theme_t3kit/commit/4c0e5ec))
- **[FIX]** Fir broken dev dependency for extension tools ([553348c](https://github.com/t3kit/theme_t3kit/commit/553348c))
- **[UPDATE]** felayout_t3kit, podio feature_61 - slider container ([5c764cf](https://github.com/t3kit/theme_t3kit/commit/5c764cf))
- **[FEATURE]** add new grid element 'slider container' (Podio Feature_61) (#80) ([6532fbe](https://github.com/t3kit/theme_t3kit/commit/6532fbe))
- **[BUGFIX]** typo in social icon element, type=string for google plus ([d76fe2c](https://github.com/t3kit/theme_t3kit/commit/d76fe2c))
- **[FEATURE]** Make the slider autoslide (Podio Feature_41) (#66) ([d8bef78](https://github.com/t3kit/theme_t3kit/commit/d8bef78))
- **[BUGFIX]** Updated composer.json with dependencies (#84) ([9315654](https://github.com/t3kit/theme_t3kit/commit/9315654))
- **[FEATURE]** Add constant for custom css path (#74) ([84fc8be](https://github.com/t3kit/theme_t3kit/commit/84fc8be))
- **[TASK]** Set correct dependency for t3kit_extension_tools ([1445b5e](https://github.com/t3kit/theme_t3kit/commit/1445b5e))
- **[BUGFIX]** Remove composer dependencies that do not exist ([690199a](https://github.com/t3kit/theme_t3kit/commit/690199a))
- **[BUGFIX]** Add repo for t3kit_extension_tools because it is not on packagist ([b1cac29](https://github.com/t3kit/theme_t3kit/commit/b1cac29))
- **[BUGFIX]** Set version for t3kit-extension-tools to be composer compatible ([b6776b0](https://github.com/t3kit/theme_t3kit/commit/b6776b0))
- **[FEATURE]** Add constant for header comment (#72) ([1291650](https://github.com/t3kit/theme_t3kit/commit/1291650))
- **[FIX]** Page access for new pages is wrong (#69) ([905b4b1](https://github.com/t3kit/theme_t3kit/commit/905b4b1))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[FEATURE]** Allow big pictures in the main content area (Podio feature_73) (#115) ([239adcd](https://github.com/t3kit/theme_t3kit/commit/239adcd))
- **[!!!]** **[BUGFIX]** Remove sitemap configuration for ukrainian and romanian (Podio bug_65) (#116) ([7cd8cbe](https://github.com/t3kit/theme_t3kit/commit/7cd8cbe))
- **[!!!]** **[TASK]** hide example wrappers, fix #109 ([91580ef](https://github.com/t3kit/theme_t3kit/commit/91580ef))
- **[!!!]** **[FEATURE]** Social icons - user friendlyness (Podio Feature_26) (#70) ([9faeffa](https://github.com/t3kit/theme_t3kit/commit/9faeffa))
- **[!!!]** **[TASK]** Update favicons (#68) ([4a29f7f](https://github.com/t3kit/theme_t3kit/commit/4a29f7f))

***

#### v1.8.0 `October 18, 2016`
- **[UPDATE]** felayout_t3kit 1.6.0 ([f8e9cc3](https://github.com/t3kit/theme_t3kit/commit/f8e9cc3))
- **[FIX]** Localized search's placeholder in header (#65) ([bccccc6](https://github.com/t3kit/theme_t3kit/commit/bccccc6))
- **[FEATURE]** Whole area link, fix #47 (#63) ([f03feca](https://github.com/t3kit/theme_t3kit/commit/f03feca))
- **[FIX]** add extensionName attribute to Contacts el for translations (#58) ([05429fb](https://github.com/t3kit/theme_t3kit/commit/05429fb))
- **[FIX]** Disabled Password Recovery Link (Login form) breaks page (Podio bug_41) (#62) ([c2ddaf4](https://github.com/t3kit/theme_t3kit/commit/c2ddaf4))
- **[FIX]** wrong class for pagination in solr (Podio bug_45) (#59) ([2f3feb0](https://github.com/t3kit/theme_t3kit/commit/2f3feb0))
- **[FIX]** Image title of header image is t3kit (Podio bug_44) (#60) ([c1ea82a](https://github.com/t3kit/theme_t3kit/commit/c1ea82a))
- **[UPDATE]** felayout_t3kit ([0f2cfe8](https://github.com/t3kit/theme_t3kit/commit/0f2cfe8))
- **[FEATURE]** navbar dropdown with columns ([48dbf5a](https://github.com/t3kit/theme_t3kit/commit/48dbf5a))
- **[FIX]** add collapsed class to closed tabs (Podio bug_43) (#53) ([b0ddef3](https://github.com/t3kit/theme_t3kit/commit/b0ddef3))
- **[FIX]** newsCarousel arrow position (Podio bug_40) ([c963ca8](https://github.com/t3kit/theme_t3kit/commit/c963ca8))
- **[FEATURE]** Add translation for telephone label ([3563f7b](https://github.com/t3kit/theme_t3kit/commit/3563f7b))
- **[FIX]** News Carousel height of date in Firefox. (Podio bug_38) (#45) ([9c73819](https://github.com/t3kit/theme_t3kit/commit/9c73819))
- **[FEATURE]** Added translation to Norwegian Bokmål (#46) ([10089f2](https://github.com/t3kit/theme_t3kit/commit/10089f2))
- **[UPDATE]** felayout_t3kit ([a2b7a7f](https://github.com/t3kit/theme_t3kit/commit/a2b7a7f))
- **[FEATURE]** add Android/iOS detection ([3706cce](https://github.com/t3kit/theme_t3kit/commit/3706cce))
- **[FIX]** php dependency version, close #43 ([3e61740](https://github.com/t3kit/theme_t3kit/commit/3e61740))

***

#### v1.7.0 `July 18, 2016`
- **[UPDATE]** felayout_t3kit 1.5.0 ([7eed7fd](https://github.com/t3kit/theme_t3kit/commit/7eed7fd))
- **[FEATURE]** Added possibility to add target _blank to the file list item (#42) ([8bc40de](https://github.com/t3kit/theme_t3kit/commit/8bc40de))
- **[UPDATE]** correct and update dependencies in ext_emconf ([2e8cd5e](https://github.com/t3kit/theme_t3kit/commit/2e8cd5e))
- **[DOC]** add CONTRIBUTING.md file ([ca1e5f9](https://github.com/t3kit/theme_t3kit/commit/ca1e5f9))
- **[DOC]** update README file ([44dd04f](https://github.com/t3kit/theme_t3kit/commit/44dd04f))

***

#### v1.6.0 `July 8, 2016`
- **[UPDATE]** felayout_t3kit 1.4.0 ([445d44b](https://github.com/t3kit/theme_t3kit/commit/445d44b))
- **[FIX]** fixed confirmation page for mail form, disable compatibility mode for TYPO3 6.2 of form (Podio bug_16) (#40) ([15f5d60](https://github.com/t3kit/theme_t3kit/commit/15f5d60))
- **[FEATURE]** add new News list template - NewsTimeline ([279fd6b](https://github.com/t3kit/theme_t3kit/commit/279fd6b))
- **[FEATURE]** add new list templates for news EXT, (cards, simple list) ([756bb83](https://github.com/t3kit/theme_t3kit/commit/756bb83))
- **[REFACTOR]** rename news-carousel element ([31826b6](https://github.com/t3kit/theme_t3kit/commit/31826b6))
- **[DOC]** add license file (Podio feature_24) ([1668b31](https://github.com/t3kit/theme_t3kit/commit/1668b31))
- **[FEATURE]** add t3kit info into site layout (Podio feature_29) ([4a372be](https://github.com/t3kit/theme_t3kit/commit/4a372be))
- **[FIX]** added bs classes for permalogin ([2d71a01](https://github.com/t3kit/theme_t3kit/commit/2d71a01))
- **[FIX]** News title with seo_basic (#39) ([7ffe0d9](https://github.com/t3kit/theme_t3kit/commit/7ffe0d9))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[FEATURE]** add news-carousel template for NEWS extension ([11a851d](https://github.com/t3kit/theme_t3kit/commit/11a851d))

***

#### v1.5.0 `June 22, 2016`
- **[UPDATE]** felayout_t3kit 1.3.0 ([455ccca](https://github.com/t3kit/theme_t3kit/commit/455ccca))
- **[FEATURE]** adds new content element 'bootstrapSlider (#37) ([079ce4f](https://github.com/t3kit/theme_t3kit/commit/079ce4f))
- **[FEATURE]** add option for parallax to hide it in mobile (< 992px) ([8d77fae](https://github.com/t3kit/theme_t3kit/commit/8d77fae))
- **[UPDATE]** felayout_t3kit 1.2.1 ([3d679a6](https://github.com/t3kit/theme_t3kit/commit/3d679a6))
- **[REFACTOR]** warning message for outdated browsers ([28dcb5a](https://github.com/t3kit/theme_t3kit/commit/28dcb5a))
- **[FIX]** Happy browser hardcoded (outdated browser) (Podio bug24) (#33) ([3646ad7](https://github.com/t3kit/theme_t3kit/commit/3646ad7))
- **[FIX]** Add language variable for placeholder text in searchbox (#32) ([89be694](https://github.com/t3kit/theme_t3kit/commit/89be694))

:heavy_exclamation_mark:**Breaking Changes:**
- **[!!!]** **[FEATURE]** modify BE layouts, subnav column - mark as Not assigned, remove Page Elements column ([6bcbce9](https://github.com/t3kit/theme_t3kit/commit/6bcbce9))
- **[!!!]** **[FIX]** disable custom.js in t3kit ([ad664f0](https://github.com/t3kit/theme_t3kit/commit/ad664f0))
- **[!!!]** **[FIX]** Changed majority of templates containing top-content, to make it possible to use the full width ([1552698](https://github.com/t3kit/theme_t3kit/commit/1552698))

***
#### v1.4.1 `June 2, 2016`
- **[FIX]** update extension version ([c17de37](https://github.com/t3kit/theme_t3kit/commit/c17de37))

#### v1.4.0 `June 2, 2016`
- **[UPDATE]** felayout_t3kit 1.2.0 ([3944b7d](https://github.com/t3kit/theme_t3kit/commit/3944b7d))
- **[FEATURE]** Adding paste toggle button with setting to plain text to let template design handle looks (#29) ([656a5f3](https://github.com/t3kit/theme_t3kit/commit/656a5f3))
- **[FIX]** fixed light box class name for news detail view (#31) ([62c3252](https://github.com/t3kit/theme_t3kit/commit/62c3252))
- **[FEATURE]** add HeaderTemplates constant ([dc76e02](https://github.com/t3kit/theme_t3kit/commit/dc76e02))

#### v1.3.1 `May 26, 2016`
- **[FIX]** video parallax template ([e246d62](https://github.com/t3kit/theme_t3kit/commit/e246d62))

#### v1.3.0 `May 13, 2016`
- **[UPDATE]** felayout_t3kit 1.1.1 ([e727128](https://github.com/t3kit/theme_t3kit/commit/e727128))
- **[FEATURE]** Adding title overrides the filename (#28) ([af810af](https://github.com/t3kit/theme_t3kit/commit/af810af))
- **[FIX]** fix parallax + bg video parallax ([8df7055](https://github.com/t3kit/theme_t3kit/commit/8df7055))
- **[FIX]** 'news-catecories' should be 'news-categories' (bug3) ([917f25e](https://github.com/t3kit/theme_t3kit/commit/917f25e))
- **[FEATURE]** new way to add tab/pill content elements based on gridelements ([0556446](https://github.com/t3kit/theme_t3kit/commit/0556446))
- **[FIX]** solr - template bug - 'remove all filters' is inside span.icon. = gets wrong font (bug19) ([904ed3c](https://github.com/t3kit/theme_t3kit/commit/904ed3c))
- **[FIX]** changed name of 'containers' in collapsible ([e0db2ba](https://github.com/t3kit/theme_t3kit/commit/e0db2ba))
- **[FEATURE]** new way to add collapsible content elements (accordion) based on gridelements ([5951a84](https://github.com/t3kit/theme_t3kit/commit/5951a84))
- **[FIX]** Could not load flexform for Parallax ([b95a5bb](https://github.com/t3kit/theme_t3kit/commit/b95a5bb))

#### v1.2.0 `May 10, 2016`
- **[DOC]** add Contributing info to README file ([87d7119](https://github.com/t3kit/theme_t3kit/commit/87d7119))
- **[UPDATE]** felayout_t3kit 1.1.0 ([07a2792](https://github.com/t3kit/theme_t3kit/commit/07a2792))
- **[FEATURE]** add parallax element ([2c12bb2](https://github.com/t3kit/theme_t3kit/commit/2c12bb2))
- **[FEATURE]** add inverse/grey-bg wrappers for content ([314db25](https://github.com/t3kit/theme_t3kit/commit/314db25))
- **[FIX]** add missed translation to icon selector ([fcd7566](https://github.com/t3kit/theme_t3kit/commit/fcd7566))
- **[FEATURE]** Possibility to add icon in the middle of the divider ([ccf788d](https://github.com/t3kit/theme_t3kit/commit/ccf788d))
- **[FEATURE]** add possibility to show link as a btn and btn as a link ([ad149ce](https://github.com/t3kit/theme_t3kit/commit/ad149ce))
- **[REFACTOR]** add class and title to ImageTextLink elem ([870c3c8](https://github.com/t3kit/theme_t3kit/commit/870c3c8))
- **[FEATURE]** add aligning - new selectbox to center text/block ([633fb85](https://github.com/t3kit/theme_t3kit/commit/633fb85))
- **[FIX]** remove itemprop in breadcrumbs ([383aa75](https://github.com/t3kit/theme_t3kit/commit/383aa75))
- **[FEATURE]** Option to use image instead of media ([e027cf4](https://github.com/t3kit/theme_t3kit/commit/e027cf4))
- **[FIX]** added missing localization for iconClass none. ([34402ee](https://github.com/t3kit/theme_t3kit/commit/34402ee))
- **[FIX]** fix versions ([5b87d41](https://github.com/t3kit/theme_t3kit/commit/5b87d41))

#### v1.1.0 `April 13, 2016`
- **[UPDATE]** felayout_t3kit, fix Print styles ([0949ce1](https://github.com/t3kit/theme_t3kit/commit/0949ce1))
- **[DOC]** add changelog file ([02b359f](https://github.com/t3kit/theme_t3kit/commit/02b359f))
- **[DOC]** update ext info ([ee169af](https://github.com/t3kit/theme_t3kit/commit/ee169af))
- **[FEATURE]** Use svg files as file-icons for the File Links element ([11b91ca](https://github.com/t3kit/theme_t3kit/commit/11b91ca))
- **[UPDATE]** felayout_t3kit, mobile-nav toggle btn left/right ([1c21060](https://github.com/t3kit/theme_t3kit/commit/1c21060))
- **[FIX]** Add markers to felogin template to show status display message and header on login page ([879cc56](https://github.com/t3kit/theme_t3kit/commit/879cc56))
- **[FEATURE]** Add theme constant for positioning mobile menu to left or right ([709b0b1](https://github.com/t3kit/theme_t3kit/commit/709b0b1))
- **[REFACTOR]** disable lang menu by default ([39abffa](https://github.com/t3kit/theme_t3kit/commit/39abffa))
- **[FIX]** remove extra greater than sign ([12d5527](https://github.com/t3kit/theme_t3kit/commit/12d5527))
- **[REFACTOR]** rename constant labels ([21bdfc8](https://github.com/t3kit/theme_t3kit/commit/21bdfc8))
- **[FEATURE]** Add item states for pages that have subpages ([9a966f1](https://github.com/t3kit/theme_t3kit/commit/9a966f1))

