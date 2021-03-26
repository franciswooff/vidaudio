# vidaudio-3
Template to support students at the University of Salford in hosting comparative audio tests online

This repository supersedes 2 earlier versions (audiotest-1 & audiotest-2) in providing a solution for comparative testing of different audio tracks synchronised to a video element. The earlier versions worked via switching between audio tracks embedded with the video file. If wider browser support of html 5 audioTracks property (used in version 1) becomes available this would be the best solution. As there seems little progress with this (e.g. the feature has been behind an enable-experimental-features flag in Chrome from v37 to current-at-time-of writing v89) v2 was created. v2 used a 3rd party video host, whose API properly supports video audio track switching. However there are some downsides (limit on number of videos which can be used, delays in track loading & switching) to this 3rd party approach.

This repository “v3” is based on the simple method of having a muted video element synchronised to a separate audio element (in the initial version a number of separate audio elements) not visible on the test page. In the initial version these hidden audio elements are muted & unmuted to provide track switching (source switching of a single audio element presents challenges around necessity to reload the player after source is changed, but will be investigated, along with other solutions less crude than the initial version).

**INSTRUCTIONS FOR USE**
The project is designed to work with little customisation needed to get an initial usable test. The minimum actions needed to use it are:

1.	Download this repository as a zip file (dropdown from the green “Code” button top right of repository) save it & unzip it to a location suitable for you to continue work with it as you prepare your test. By default the zip file may unzip to a "folder within a folder", it is the inner folder (containing multiple files & 5 other folders, the same layout as seen above these instructions on GitHub) that you will work with. From this point onward in these instructions this folder will be referred to as your test folder.

2.	While you can work on preparing your test in your test folder on a location such as the hard drive of your PC (or Mac, portable hard drive, USB stick or cloud storage) for the test to run it will need to be placed on a machine running PHP - e.g. a web server (you could install or activate PHP on your Windows PC or Mac & the test will run there, but as your your subjects will need access it needs to be on a web server anyway).  
For University of Salford students using this test, this article: https://salfordprod.service-now.com/kb_view.do?sysparm_article=KB0010645 “covers basic use of the University service for hosting web content” (obtaining & using a web server account for your test).  
The test as you have downloaded it in step 1 includes placeholder/example audio & video files which it is set to work with. So you can, if you wish, simply upload the downloaded test to your webserver account at this point to see an example of it working, even before you set it up with your own files. You don’t need to do this, but it may help if you work through the steps in the guide to access your web server account, so that if you have any issue & need a hand you have more time prior to when you start testing.
Note that as stressed in the guide you need to upload the **contents** of your test folder to the server (rather than the folder itself).  
See step 7 for addresses to use in a web browser to see the uploaded project.

3.	Prepare the video & audio files you will use in your test. The project is set up to work with .mp4 video files & .wav audiofiles. Other file formats are possible, the code downloaded in step 2 can be adapted to accomodate.  
.mp4 video is a good choice for widest browser compatibility, if you move to another video codec this may restrict this. Make the videos as small (quality/datarate) as possible to minimise size on the server & connection bandwidth (minimising delays over the internet & use of the test subject’s broadband/phone data plan). A 360px 24fps low datarate video is a typical good choice for use with this project.  
Adobe MediaEncoder is one useful application for changing sizes, codecs, datarates etc. of audio & video files. If you don’t have access to this VLC can also carry out these functions https://www.vlchelp.com/convert-video-format/. If using the conversion function in VLC preset profiles like "Video for Android SD High" or"Video for YouTube SD" are suitable, but these tie the output to a fixed aspect ratio that may not match your source (changing the output width to automatic will avoid stretching). Video datarate can be reduced further to 200kbps & audio rate to 64kbps or lower (as this audio will not be heard, however do not untick the "audio codec" box to remove audio alogether).  
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

Congratulations! You should have a working test which you can use with no further steps* Hopefully the format the results arrive in via e-mail is self-explanatory (& easy to bring into e.g. Excel, use the underscore as a separator). The following steps provide additional functions which you may use, but do not have to:  
\* note however, that if you are not using labels or custom text on test pages, as described in steps 8 & 9, you will need to delete the example files in the “labels” & “extras” folders, detail (if needed) is provided as step 10

8.	**To add a scale label to your sliders** - somewhat similar process to setting your numbers of videos & e-mail etc. via editing a text file. To add a scale to the sliders on a particular page place a text file in the folder “labels”. A scale label for your first test page would be “1.txt”, for the third page would be “3.txt” etc. (no issue for a page to have no label text file allocated).  
The label format is 5 rows, but you can use whichever of these you like - so you could use only the top & bottom rows to give labels to each end of the slider, top, middle & bottom for a 3 point scale etc. Each label is a separate line in the text file & you need to leave lines blank where you aren’t using a 5 point scale. Top & bottom labels should have 3 blanks lines between them. A 3 point scale would be top label on the first line, blank line, middle label on the third line, blank line, bottom label on the fifth line. 5 point scale = lines 1-5 of the text file, with the top label on the first line.  
The labels folder in your downloaded project folder contains example labels for pages 2 & 3. Check the format of these as a guide. You will need to either delete these files if you are not using labels on pages 2 & 3 or edit them to your labels if you are.

9.	**To include extra custom text on any test page** - similar to 8. above. To add additional text, appearing as a paragraph or paragraphs below the standard instructions on a particular page place a text file in the folder “extras”. The text for your first test page would be “1.txt”, for the third page would be “3.txt” etc. (no issue for a page to have no text file allocated).  
For a single paragraph without line breaks the format is simply the text in the text file = the text of that paragraph.  
To insert a line break at any point use the code \<br>  Note that breaking to a new line in your text file will not break to a new line on the test page without use of this tag.  
For multiple paragraphs it is necessary to use the html paragraph tags \<p> to start a paragraph & \</p> to end one. Note though that you don’t need to include these for starting your first paragraph or ending your last, as those tags are included in the default code of the page (enabling the single paragraph without tags use first detailed in this step).  
The extras folder in your downloaded project folder contains example paragraphs for pages 1 & 3. Check the format of "3.txt" for examples of line break & paragraph break. You will need to either delete these files if you are not using labels on pages 1 & 3 or edit them to your text if you are.  

10.	**If you are not using labels or custom text on your test pages** you will need to clear the examples provided. This is best done by deleting the text files in the “labels” & “extras” folders (leaving those folders empty). If you prefer to delete the folders altogether this is fine too, but you’ll need to recreate them if you change your mind (a good middle ground would be to keep the local files & folders in your downloaded project folder, but not have them on the server).

11. **To turn off randomisation of linking audio tracks to rating sliders for specified pages** - by default the test pages randomise the order in which your audio tracks for that page/video are linked to the rating slider/switch button pairs. If you wish to turn this randomisation off for any given page(s) - typically where you are providing a "training page" & so need the audio tracks to map consitently to the slider/button pairs - this can be done by including a 4th line to your EDITME.txt file specifying the page numbers separated by commas. Examples are shown in the EDITME.txt file.

12.	**Further customisation of text on the pages of your test** (the actual test page or the start & end pages) is also possible. This means venturing a little into the world of html text. For an introduction & reference see https://www.w3schools.com/html  
You don’t need a specialist code editing application to do this, you can edit with Notepad on Windows or TextEdit on Mac OS. It may be easier with something that colour codes the different parts of the code though. As well as code editing applications your Microsoft OneDrive will display the code like this if you view & edit the files online (via a web browswer).  
The start page is “index.html”. To add a paragraph insert one in \<p> tags below the one that’s already there (you will see this place marked, along with some instructions, in the code of the page).  
Editing the code of the test page “page.php” & the end page “end.php” is trickier, as php is more likely to “break” than html. To edit the standard instructions of the test page edit between the \<p> & \</p> tags on lines 62-64. If you wish to remove the standard instructions altogether delete lines 62-64. Note that in customising this way you are customising every test page, any customisation to an individual page’s instructions should be by the method in step 9.  
To edit the standard message on the end page either customise or replace the text between the \<p> & \</p> tags on line 16.  

13. **Adding a second test with different parameters to directly follow the initial test** - could be by placing the second test in a subfolder of your project folder/public_html & following details in step 12. above to include text & a link on your first test end page to direct the test subject to the second test.  
E.g. edit the "Thanks" paragraph (line 16) to \<p>There now follows a second part to the test, please click \<a href="test2/">this link\</a> (you will need to enter your participant number again)\</p> (test2 used as an example for the name of the folder containing your second test). Edit the subject line of the email you receive (line 38 of the end page for the second test) to distinguish results for the second test from the first.  

14.	**To extensively modify the test** - for example to swap the use of videos for still images or work with a 7 point slider scale - either follow the approach of step 11 (the pages likely to be concerned are “page.php” & “preview.php”) or if you are looking for something where the customisation is more to individual pages you might set the test up as closely as possible to what you want, copy the code of the pages to be changed (right click & “view source” in a browser), save these as new html files, perform the edits & incorporate them into your test.

Additional functionality/features to be added:
1.	~~Add further instructions on GitHub~~
2.	~~Preview page to show scale labels & extra custom text from 8 & 9 above~~
3.	~~Extend extra custom text function to allow multiple lines, breaks & paragraphs~~
4.	~~Recommend setting for VLC encoder~~
5.	~~Randomisation of audio track to slider allocation~~
6.	~~Option to turn above randomisation off for specified pages~~
7.	Check responsiveness (presentation on mobile screen)
8.	~~Implement validation of number input from page form (copy from participant number validation)~~
9.	Option to make participant number mandatory
10.	Check if throttling audio/video sync to a lower frequency improves initial video stuttering
11.	Option to have an extra introductory (instructions etc.) page to any test page
12.	Option to randomise order of test pages
14.	Introduce small crossfades or silences to avoid audio glitching on track switching & looping
15.	Check if additional audio to video play/pause syncing solves issue with use of laptop hardware play button/keyboard shortcut. If not add to instructions to warn of issue
16.	Requests for input from UoS students:  
~~improve wording of "I agree" label on start page?  
improve wording of "audio variation" etc. on test page~~  
should videos autoplay?  
whether to include sample labels & extra text files in main project folder or restructure (including move of example video & audio files to 2nd folder & ability to include alternate pages - e.g. re requirement 9 above)  
results mail can be formatted differently (order or separators) if preffered
