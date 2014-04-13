#!/bin/sh
BASEDIR=$(dirname $0)

mkdir -p ~/.config/sublime-text-3/Packages/
cd ~/.config/sublime-text-3/Packages/

#tema
git clone https://github.com/kkga/spacegray.git "Theme - Spacegray"

mkdir User

cp $BASEDIR/standards/Preferences.sublime-settings User/Preferences.sublime-settings
cp $BASEDIR/standards/CSS.sublime-settings User/CSS.sublime-settings
cp $BASEDIR/standards/JavaScript.sublime-settings User/JavaScript.sublime-settings
cp $BASEDIR/standards/HTML.sublime-settings User/HTML.sublime-settings

#plugins
git clone https://github.com/benmatselby/sublime-phpcs.git PHPCS

git clone https://github.com/SublimeLinter/SublimeLinter3.git SublimeLinter

git clone https://github.com/spadgos/sublime-jsdocs.git DocBlock

git clone https://github.com/victorporof/Sublime-JSHint.git JSHint

git clone git://github.com/jisaacks/GitGutter.git

git clone git@github.com:facelessuser/ApplySyntax.git

git clone -b BH2ST3 git@github.com:facelessuser/BracketHighlighter.git

git clone https://github.com/sergeche/emmet-sublime Emmet

git clone git@github.com:titoBouzout/SideBarEnhancements.git

git clone https://github.com/s-a/sublime-text-refactor.git Refactor

git clone git@github.com:SublimeCodeIntel/SublimeCodeIntel.git

git clone git@github.com:davidrios/jade-tmbundle.git

cp $BASEDIR/standards/.jshintrc JSHint/.jshintrc