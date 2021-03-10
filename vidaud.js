const vid = document.querySelector('video');
const aud = document.querySelectorAll('audio');
const img = document.querySelectorAll('img');
const slid = document.querySelectorAll('[type=range]');
const spn = document.querySelectorAll('span');
const nmbx = document.querySelectorAll('[type=number]');
let vt;
let at;

slid[0].style.pointerEvents = "auto";
spn[0].style.backgroundColor = 'white';
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
//  prnt();
});

//prnt = () => {
//  nmbx[0].value = vt;
//  nmbx[1].value = at;
//};

aud[0].addEventListener('timeupdate', () => {
  at = aud[0].currentTime;
  vid.currentTime = at;
  vt = vid.currentTime;
//  let vtr = vt.toFixed(1);
//  nmbx[2].value = vtr;
//  let atr = at.toFixed(1);
//  nmbx[3].value = atr;
});

spn.forEach(prsd);
function prsd(item, index) {
  let x = index;
  item.addEventListener('click',function(){    
    let i;
    for (i = 0; i < spn.length; i++){
      slid[i].style.pointerEvents = "none";
      spn[i].style.backgroundColor = 'gray';
      aud[i].muted = true;
    }

  slid[x].style.pointerEvents = "auto";
  spn[x].style.backgroundColor = 'white';
  aud[x].muted = false;
  })
}

slid.forEach(slide);
function slide(item, index) {
  item.addEventListener('input',function(){
    let i = index;
    spn[i].innerHTML = this.value;
  })
}