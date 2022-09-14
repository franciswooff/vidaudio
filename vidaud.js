const vid = document.querySelector('video');
const aud = document.querySelectorAll('audio');
const img = document.querySelectorAll('img');
const slid = document.querySelectorAll('[type=range]');
const slidR = document.querySelector('.R');
const spn = document.querySelectorAll('span');
let vt;
let at;

spn[0].style.backgroundColor = 'white';
if (slidR == null) {
  slid[0].style.pointerEvents = "auto";
}
aud[0].muted = false;

img[0].addEventListener('click', () => {
  for (i = 0; i < aud.length; i++){
    aud[i].play();
  }
  vid.play();
});

img[1].addEventListener('click', () => {
  for (i = 0; i < aud.length; i++){
    aud[i].pause();
  }
  vid.pause();
});

aud[0].addEventListener('timeupdate', () => {
  at = aud[0].currentTime;
  vid.currentTime = at;
  vt = vid.currentTime;
});

spn.forEach(prsd);
function prsd(item, index) {

  let x = index;

  item.addEventListener('click',function(){

    for (i = 0; i < spn.length; i++){
      aud[i].muted = true;
      spn[i].style.backgroundColor = 'gray';
      slid[i].style.pointerEvents = "none";
    }

  spn[x].style.backgroundColor = 'white';
  slid[x].style.pointerEvents = "auto";
  if (slidR != null) {
    slidR.style.pointerEvents = "none";
  }
  aud[x].muted = false;
  })

}