# vidaudio-3
Template to support students of the University of Salford in hosting comparative audio tests online

This repository supersedes 2 earlier versions (audiotest-1 & audiotest-2) in providing a solution for comparative testing of different audio tracks synchronised to a video element*. The earlier versions worked via switching between audio tracks embedded with the video file. If wider browser support of html 5 audioTracks property (used in version 1) becomes available this would be the best solution. As there seems little progress with this (e.g. the feature has been behind an enable-experimental-features flag in Chrome from v37 to current-at-time-of writing v89) v2 was created. v2 used a 3rd party video host, whose API properly supports video audio track switching. However there are some downsides (limit on number of videos which can be used, delays in track loading & switching) to this 3rd party approach.

This repository “v3” is based on the simple method of having a muted video element synchronised to a separate audio element (in the initial version a number of separate audio elements) not visible on the test page. In the initial version these hidden audio elements are muted & unmuted to provide track switching (source switching of a single audio element presents challenges around necessity to reload the player after source is changed, but will be investigated, along with other solutions less crude than the initial version).

**INSTRUCTIONS FOR USE**
The project is designed to work with little customisation needed to get an initial usable test. The minimum actions needed to use it are:

1.	Download this repository as a zip file (dropdown from the green “Code” button top right of repository) save it & unzip it to a location suitable for you to continue work with it as you prepare your test. From this point onward in these instructions this folder will be referred to as your test folder.

2.	While you can work on preparing your test in your test folder on a location such as the hard drive of your PC (or Mac, portable hard drive, USB stick or cloud storage) for the test to run it will need to be placed on a machine running PHP - e.g. a web server (you could install or activate PHP on your Windows PC or Mac & the test will run there, but as your your subjects will need access it needs to be on a web server anyway).  
For University of Salford students using this test, this article: https://salfordprod.service-now.com/kb_view.do?sysparm_article=KB0010645 “covers basic use of the University service for hosting web content” (obtaining & using a web server account for your test).  
The test as you have downloaded it in step 1 includes placeholder/example audio & video files which it is set to work with. So you can, if you wish, simply upload the downloaded test to your webserver account at this point to see an example of it working, even before you set it up with your own files. You don’t need to do this, but it may help if you work through the steps in the guide to access your web server account, so that if you have any issue & need a hand you have more time prior to when you start testing.
Note that as stressed in the guide you need to upload the **contents** of your test folder to the server (rather than the folder itself).  
See step 7 for addresses to use in a web browser to see the uploaded project.

3.	Prepare the video & audio files you will use in your test. The project is set up to work with .mp4 video files & .wav audiofiles. Other file formats are possible, the code to be downloaded in step 2 will need to be adapted for these.  
.mp4 video is a good choice for widest browser compatibility, if you move to another video codec this may restrict this. Make the videos as small (quality/datarate) as possible to minimise size on the server & connection bandwidth (minimising delays over the internet & use of the test subject’s broadband/phone data plan). A 360px 24fps low datarate video is a typical good choice for use with this project.  
Adobe MediaEncoder is one useful application for changing sizes, codecs, datarates etc. of audio & video files. If you don’t have access to this VLC can also carry out these functions https://www.vlchelp.com/convert-video-format/  
.wav format is chosen for audio as it best matches the requirements of the University of Salford students the project was created for. It is not the best choice in terms of size on the server, connection bandwidth etc. To change the format the test works with to (e.g.) mp3 edit the single occurrence each in preview.php & page.php of the text “wav” to “mp3”  
The test accommodates your choice of number of videos to be used. The test accommodates your choice of number of audio tracks to be available per video, however in the initial version that number has to be the same across your videos (e.g. 4 audio tracks with each video across the test). The length (time) of your different videos does not need to be the same, but the length (time) of the audio tracks to be used with a given video must match that of the video & each other.

4.	Place your video files in the “videofiles” folder inside your test folder (delete or overwrite the placeholder/example files already there). The files must be named according to the following convention:  
  1.mp4  
  2.mp4  
  3.mp4  
  etc.

5.	Place your audio files in the “audiofiles” folder inside your test folder (delete or overwrite the placeholder/example files already there). The files must be named according to the following convention:  
  1_1.wav  
  1_2.wav  
  2_1.wav  
  etc.  
Where 1_2.wav is the first video’s second audio file, 2_1.wav the second video’s first audio file etc.

6.	Edit the text file EDITME.txt in your test folder. This file “tells” the test the number of videos to be used in the test (first line of the file), the number of audio tracks with each video (second line of the file) & the e-mail address the test results are to be sent to (third line of the file). Easiest to open the file & see how it looks before editing - instructions are also included in the file itself & should be easy to follow in that context.

7.	Upload your test to the server (see item 2 in these instructions) - or if you already had a “trial run” as recommended in step 2 replace the example video & audio files with the ones you have added to your folders in steps 4 & 5 & the EDITME.txt file with the new version from step 6.  
Enter your webserver account address followed by /preview.php (e.g. http://abc123.poseidon.salford.ac.uk/preview.php) in a browser to check your files are on the server & correctly named etc. in the preview page of the test. Your webserver account address without any page specified (e.g. http://abc123.poseidon.salford.ac.uk) will take you to the start page of the test as used by the test subject.

Congratulations! You should have a working test which you can use with no further steps (hopefully the format the results arrive in via e-mail is self-explanatory). The following steps provide additional functions which you may use, but do not have to:

(further instructions to be added here)
8.	How to add a scale label to your faders 
9.	How to include extra custom text on any test page

Additional functionality/features to be added:
1.	Add further instructions on GitHub
2.	Preview page to show scale labels & extra custom text from 8 & 9 above
3.	Randomisation of audio track to fader allocation
4.	Option to turn above randomisation off for specified pages
5.	Option to have an extra introductory (instructions etc.) page to any test page
6.	Option to make participant number mandatory
7.	Option to randomise order of test pages
8.	Improve responsiveness- presentation smaller screen - e.g. poor breaking of "I agree" label on test start page on mobile
9.	Requests for input from UoS students:  
improve wording of "I agree" label on start page?
improve wording of "audio variation" etc. on test page

