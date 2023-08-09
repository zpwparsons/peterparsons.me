<div>
    My current setup (end 2022 edition)
    ===================================

    Original – [Oct 19th 2022](https://freek.dev/2357-my-current-setup-end-2022-edition) by Freek Van der Herten – 12 minute read

    After tweeting out a screenshot, it often get questions around [which editor](https://twitter.com/bashgeek/status/1053559280035491840), [font](https://twitter.com/yeetstar55/status/1053564989091573761) or color scheme I'm using. Instead of replying to those questions individually I've decided to just write down the settings and apps that I'm using.

    IDE
    ---

    I mainly program PHP. Mostly I develop in [PhpStorm](https://www.jetbrains.com/phpstorm). Here's a screenshot of it:

    ![](https://freek.dev/admin-uploads/RhKHuPdW3mc1lATeCSHH9ELuT6e9ttXHFbq9kgsP.jpg)

    I'm using [phpstorm-light-lite-theme](https://github.com/brendt/phpstorm-light-lite-theme) which was handcrafted by Brent Roose. The font used is Menlo. Font size is 15, line height 1.6

    Like seen in the screenshot I've hidden a lot of things of the UI of PhpStorm. I like to keep it minimal. I like working using a light based theme. In some circles this is [maybe a bit controversial](https://twitter.com/Loruzzz/status/1053561991934214144). Watch [this excellent video](https://youtu.be/rDMI1dpNfdw?t=353) by my colleague Brent to learn what the benefits of using a light based theme are.

    Mostly I work on Laravel projects. One of my favourite PhpStorm extensions is [Laravel Idea](https://laravel-idea.com), which can do stuff like autocomplete route names, request fields, and a whole lot more. It's paid, but definitely worth it.

    Another PhpStorm plugin that I use is [the Pest Plugin](https://plugins.jetbrains.com/plugin/14636-pest). It makes [Pest](https://pestphp.com) a first class citizen in the IDE. This one is free.

    Terminal
    --------

    Here's a screenshot from my terminal.

    ![](https://freek.dev/admin-uploads/FxESoLQdZHvfKS3qRxDeM6Y15sbrge1aHhcZvMH6.jpg)

    All my terminal settings are saved in [my dotfiles repository](https://github.com/freekmurze/dotfiles). If you want the same environment you follow the installation instructions of the repo.

    My terminal of choice is [iTerm2](https://www.iterm2.com/). I'm using the [Z shell](https://en.wikipedia.org/wiki/Z_shell) and [Oh My Zsh](https://ohmyz.sh/).

    The color scheme used is [a slightly modified version of Solarized Dark](https://github.com/freekmurze/dotfiles/blob/master/misc/Solarized%20Dark%20Corrected.itermcolors). The font used is [a patched version of Menlo](https://github.com/freekmurze/dotfiles/blob/master/misc/Menlo-Powerline.otf). I'm using several hand crafted [aliases](https://github.com/freekmurze/dotfiles/blob/master/shell/.aliases) and [functions](https://github.com/freekmurze/dotfiles/blob/master/shell/.functions).

    MacOS
    -----

    I'm a day one upgrader of MacOS, so I'm always using the latest version. I also sometimes dare to use beta versions of MacOS when people are saying it's stable enough.

    By default I hide the menu bar and dock. I like to keep my desktop ultra clean, even hard disks aren't allowed to be displayed there. On my dock there aren't any sticky programs. Only apps that are running are on there. I only have a stacks to Downloads and Desktop permanently on there. Here's a screenshot where I've deliberately moved my pointer down so the dock is shown.

    ![Dock](https://freek.dev/uploads/media/setup-2021/dock.png)

    I've also hidden the indicator for running apps (that dot underneath each app), because if it's on my dock it's running.

    In [my dotfiles repo](https://github.com/freekmurze/dotfiles) you'll find [my custom MacOS settings](https://github.com/freekmurze/dotfiles/blob/master/macos/set-defaults.sh).

    [The spacey background I'm using](https://512pixels.net/downloads/macos-wallpapers/10-6.png) was the default one on OSX 10.6 Snow Leopard. If you would like to use a class OSX background to, head over to [this page at 512pixels.net](https://512pixels.net/projects/default-mac-wallpapers-in-5k/).

    One the most important apps that I use is the excellent [Raycast](https://www.raycast.com). It allows make me to quickly do basic tasks such as opening up apps, locking my computer, empting the trash, and much more. One of the best built in functions is the clipboard history. By default, MacOS will only hold one thing in your clipboard, with Raycast I have a seemingly unending history of things I've copied, and the clipboard even survives a restart. It may sound silly, but I find myself using the clipboard history multiple times a day, it's that handy.

    ![](https://freek.dev/admin-uploads/u0Zbzr6I1c4RqIRqXKnkwl5ZqeSvZMLvsvE92qve.jpg)

    Raycast is also a window manager. I often work with two windows side by side: one of the left part of the screen, the other one on the right. I've configured Raycast with these window managing shortcuts:

    *   ctrl+opt+cmd+arrow left: resize active window to the left half of the screen
    *   ctrl+opt+cmd+arrow right: resize active window to the right half of the screen
    *   ctrl+opt+cmd+arrow right: resize active window to take the whole screen

    I've installed these Raycast extensions:

    *   [JetBrains Recent Projects](https://www.raycast.com/gdsmith/jetbrains): this one allows me to open up a PhpStorm project from anywhere

    ![](https://freek.dev/admin-uploads/XBEaHKp2vESglW1P7Me0udDENCNvJwFUTqBApfH3.jpg)

    *   [Laravel Docs](https://www.raycast.com/indykoning/laravel-docs): allows me to search the Laravel Docs from anywhere

    ![](https://freek.dev/admin-uploads/Sx7QZZP2onXFn3Fo7wCBROgVxjeWsiWEJxIfMDQi.jpg)

    *   [Tailwind Docs](https://www.raycast.com/vimtor/tailwindcss): search the Tailwind docs from anywhere
    *   [Tuple Call Starter](https://www.raycast.com/inxilpro/tuple): start a Tuple call with one of my colleagues
    *   [Oh Dear](https://www.raycast.com/andreaselia/ohdear). I also use Raycast to quickly resize any windows

    These are some of the other apps I'm using:

    *   To run projects locally I use [Laravel Valet](https://laravel.com/docs/9.x/valet).
    *   To connect to S3, FTP (?) and sftp servers I use [Transmit](https://panic.com/transmit/).
    *   [Ray](https://myray.app) is a little homegrown tool that I use for debugging apps.
    *   Local mail testing is done with [Nodemailer](https://nodemailer.com/about/). This handly little app install a local mailserver. In the apps you develop locally you can use that webserver to send mails. You can inspect all sent mails in Nodemailers beautiful, native UI.
    *   Sometimes I need to run an arbitrary piece of PHP code. [CodeRunner](https://coderunnerapp.com/) is an excellent app to do just that.
    *   [Paw](https://paw.cloud/) is an amazing app to perform API calls.
    *   Databases are managed with [TablePlus](https://tableplus.com/)
    *   My favourite cloud storage solution is [Dropbox](https://dropbox.com). All my personal documents are on there and at [Spatie](https://spatie.be) we use it extensively too.
    *   If you're not using a password manager, you're doing it wrong. I use [1Password](https://1password.com/). Personal passwords are sync in a vault stored on Dropbox. For Spatie we have a team account.
    *   All settings of my apps are backupped to Dropbox through [Mackup](https://github.com/lra/mackup). This is a fantastic piece of software that moves all your preferences to Dropbox and symlinks them.
    *   I don't use Time Machine, my backups are handled with [Backblaze](https://www.backblaze.com/).
    *   Tweets are tweeted with [Tweetbot](https://tapbots.com/tweetbot/mac/).
    *   I read a lot of blogs through RSS feeds in [Reeder](http://reederapp.com/mac/).
    *   Mails are read and written in [Mimestream](https://mimestream.com). Unlike other email clients which rely on IMAP, Mimestream uses the full Gmail API. It super fast, and the author is dedicated using the latest stuff in MacOS. It's a magnificent app really.
    *   My browser of choice is Safari, because of its speed and low power use. To block ads on certain sites I use [the AdGuard plugin](https://adguard.com/en/adguard-safari/overview.html).
    *   I like to write long blogposts in [iA Writer](https://ia.net/writer)
    *   To create [videos](https://spatie.be/videos) I use [ScreenFlow](https://www.telestream.net/screenflow/overview.htm).
    *   I regularly [stream stuff on YouTube](https://www.youtube.com/c/FreekVanderHerten/featured). For that I use [Ecamm Live](https://www.ecamm.com)
    *   To pair program with anyone in my team, I use [Tuple](https://tuple.app). The quality of the shared screen and sound is fantastic.
    *   Even though I'm not a designer I sometimes have to edit images. For this I use [Pixelmator](https://www.pixelmator.com/pro/).
    *   [DaisyDisk](https://daisydiskapp.com) is a nice app that helps you determine how your disk space is being use used.
    *   Outside of programming, I also [record music](/music). My DAW of choice is [Ableton](https://www.ableton.com), I'm using the complete edition.

    iOS
    ---

    Here's a screenshot of my current homescreen.

    ![](https://freek.dev/admin-uploads/u5tw84os49wxmxiZhXsdUCeeMKtb2yDga6wgY2Rj.jpg)

    I don't use folders and try to keep the number of installed apps to a minimum. There's also just one screen with apps, all the other apps are opened via search. Most of my time is spent in Safari, Pocket, Reeder and Tweetbot. Notifications and notification badges are turned off for all apps except Messages.

    Here's a rundown of some of the apps currently on the homescreen:

    *   1Password: my favourite password manager
    *   Air Video HD: I find it much more reliable to sync videos to this one the stock Videos app. No iTunes needed.
    *   Overcast: an excellent podcast client
    *   Telegram: most of my geeky friends are on there
    *   iA writer: to quickly write some stuff or take notes on the go
    *   Clock: tick, tock, ...
    *   Home: my home is full off HomeKit controlled lights, which I switch on/off using this app
    *   Reeder: an RSS client
    *   Slack: for communicating with my team and some other communities
    *   Letterboxd: a pretty imdb. I use it to log every movie I watch
    *   Railer: to easily look up the train schedules in Belgium
    *   Pocket: my favourite read later service
    *   Things: contains my to dos
    *   Nuki: this controls the electronic doorlock at our office

    There's no other screens setup. I use the App Library to hunt down any app I want to use that isn't on the home screen.

    Hardware
    --------

    Here's a picture of the desk I have at home.

    ![](https://freek.dev/admin-uploads/ZtbDg8mLYy965iR67s1XLFcDtXvCeo8EECDbbfCV.jpg)

    You might be surprised to see a lot of synths there. Next to programming, my big passion is recording music under my artist name Kobus. You can find my music on [Spotify](https://open.spotify.com/artist/6m5chdjU0M8j8bMmckXRkc) and [Apple Music](https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&ved=2ahUKEwjS_qTsju36AhVHC-wKHRXACisQFnoECBMQAQ&url=https%3A%2F%2Fmusic.apple.com%2Fbe%2Fartist%2Fkobus%2F1529028832&usg=AOvVaw3XXuuFXL9EsayAIhxew2Kh).

    Behind my desk there's a [Hue Light Strip](https://www.philips-hue.com/en-us/products/smart-lightstrips). When working in the evening, I like to set it to a moody color.

    I'm using a MacBook Pro 14" with an Apple M1 Pro processor, 16GB of RAM and 1T hard disk.

    ![](https://freek.dev/admin-uploads/ENyspoUA7bzKihpfUwM8u23xXN4PJQWDIqJIoOMV.jpg)

    I usually work in [closed-display mode](https://support.apple.com/en-us/HT201834). To save some desk space, I use a beautiful vertical Mac stand: the [Twelve South BookArc](https://www.twelvesouth.com/products/bookarc-macbook?variant=31443535724601).

    Here's the hardware that is on my desk

    *   a space grey wireless Apple Magic Keyboard with TouchId numeric keys
    *   a space grey Apple Magic Trackpad 2
    *   an [LG 32UK550-B](https://www.lg.com/sg/consumer-monitors/lg-32UK550-B) external monitor
    *   a [Livboj Wireless charger](https://www.ikea.com/gb/en/p/livboj-wireless-charger-black-90465245)
    *   two [Elegato Air](https://www.elgato.com/en/gaming/key-light-air) lights. These make a tremedous difference in quality when streaming
    *   a [Sure SM7B mic](https://www.shure.com/en-MEA/products/microphones/sm7b)
    *   a [Rode PSA1 boom arm](http://www.rode.com/accessories/psa1)
    *   when streaming, I use a [Streamdeck](https://www.elgato.com/en/stream-deck) to quickly switch scenes in Ecamm Live.

    As a webcam I use a [Sony a6400 camera](https://www.sony.com/electronics/interchangeable-lens-cameras/ilce-6400) with a [Sigma 16mm 1.4 lens](https://www.sigma-global.com/en/lenses/c017_16_14/). It is connected to my computer via an [Elgato Cam Link 4K](https://www.elgato.com/en/cam-link-4k). The camera also mounted on a [Rode PSA1 boom arm](http://www.rode.com/accessories/psa1), and when I'm not using it, the camera is behind my monitor.

    To connect all external hardware to my MacBook I got a [CalDigit TS3 plus](https://www.caldigit.com/ts3-plus/). This allows me to connect the webcam / mic / USB Piano keyboard, and more to my MacBook with a single USB-C cable. That cable also charges the MacBook. Less clutter on the desktop, means I have more headspace, so I'm pretty happy with the TS3 plus.

    I play music on a HomePod stereo pair. To stay in "the zone" when commuting and at the office I put on my [QuietComfort 35 wireless headphones](https://www.bose.com/en_us/products/headphones/over_ear_headphones/quietcomfort-35-wireless-ii.html).

    My current phone is an iPhone 14 Pro Max with 128 GB of storage.

    Misc
    ----

    *   At [Spatie](https://spatie.be), we use [Google Workspace](https://workspace.google.com) to handle mail and calendars
    *   High level planning at the company is done using [Float](https://www.float.com)
    *   All servers I work on are provisioned by [Forge](https://forge.laravel.com).
    *   The performance and uptime of those servers are monitored via [Oh Dear](https://ohdear.app).
    *   To track exceptions in production, we use [Flare](https://flareapp.io)
    *   To send mails to our audience that is interested in [our paid products](https://spatie.be/products), we use our homegrown [Mailcoach](https://mailcoach.app).

    If you want to know some more tools we use at Spatie, go over to [the uses page on our company website](https://spatie.be/uses).

    In closing
    ----------

    Every year, I write a new version of the post. Here's [the 2021 version](https://freek.dev/2119-my-current-setup-end-2021-edition).

    If you have any questions on any of these apps and services, feel free to contact me [on Twitter](https://twitter.com/freekmurze).
</div>
