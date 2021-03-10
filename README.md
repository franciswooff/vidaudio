# vidaudio-3
Template to support students of the University of Salford in hosting comparative audio tests online

This repository supersedes 2 earlier versions (audiotest-1 & audiotest-2) in providing a solution for comparative testing of different audio tracks synchronised to a video element*. The earlier versions worked via switching between audio tracks embedded with the video file. If wider browser support of html 5 audioTracks property (used in version 1) becomes available this would be the best solution. As there seems little progress with this (e.g. the feature has been behind an enable-experimental-features flag in Chrome from v37 to current-at-time-of writing v89) v2 was created. v2 used a 3rd party video host, whose API properly supports video audio track switching. However there are some downsides (limit on number of videos which can be used, delays in track loading & switching) to this 3rd party approach.

This repository “v3” is based on the simple method of having a muted video element synchronised to a separate audio element (in the initial version a number of separate audio elements) not visible on the test page. In the initial version these hidden audio elements are muted & unmuted to provide track switching (source switching of a single audio element presents challenges around necessity to reload the player after source is changed, but will be investigated, along with other solutions less crude than the initial version).

**INSTRUCTIONS FOR USE**
The project is designed to work with very little customisation needed to get an initial usable test.  These minimum actions are:
1.	Download 
