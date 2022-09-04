<!DOCTYPE html>
<html>
<head>
	<title>Page not Found</title>

<style>

body {
  height: 100%;
}
body {
  display: flex;
  align-items: center;
  justify-content: center;
  font-family:"Nunito Sans";
  color: var(--blue);
  font-size: 1em;
}
button {
  font-family:"Nunito Sans";
}
ul {
  list-style-type: none;
  padding-inline-start: 35px;
}
svg {
  width: 100%;
  visibility: hidden;
}
h1 {
  font-size: 7.5em;
  margin: 15px 0px;
  font-weight:bold;
}
h2 {
  font-weight:bold;
}
.hamburger-menu {
  position: absolute;
  top: 0;
  left: 0;
  padding: 35px;
  z-index: 2;

  & button {
    position: relative;
    width: 30px;
    height: 22px;
    border: none;
    background: none;
    padding: 0;
    cursor: pointer;

    & span {
      position: absolute;
      height: 3px;
      background: #000;
      width: 100%;
      left: 0px;
      top: 0px;
      transition: 0.1s ease-in;
      &:nth-child(2) {
        top: 9px;
      }
      &:nth-child(3) {
        top: 18px;
      }
    }
  }
  & [data-state="open"] {
    & span {
      &:first-child {
        transform: rotate(45deg);
        top: 10px;
      }
      &:nth-child(2) {
        width: 0%;
        opacity:0;
      }
      &:nth-child(3) {
        transform: rotate(-45deg);
        top: 10px;
      }
    }
  }
}
nav {
  position: absolute;
  height: 100%;
  top: 0;
  left: 0;
  background: var(--green);
  color: var(--blue);
  width: 300px;
  z-index: 1;
  padding-top: 80px;
  transform: translateX(-100%);
  transition: 0.24s cubic-bezier(.52,.01,.8,1);
  & li {
    transform: translateX(-5px);
    transition: 0.16s cubic-bezier(0.44, 0.09, 0.46, 0.84);
    opacity: 0;
  }
  & a {
    display: block;
    font-size: 1.75em;
    font-weight: bold;
    text-decoration: none;
    color: inherit;
    transition: 0.24s ease-in-out;
    &:hover {
      text-decoration: none;
      color: var(--white);
    }
  }
  /**/
}
.btn {
  z-index: 1;
  overflow: hidden;
  background: transparent;
  position: relative;
  padding: 8px 50px;
  border-radius: 30px;
  cursor: pointer;
  font-size: 1em;
  letter-spacing: 2px;
  transition: 0.2s ease;
  font-weight: bold;
  margin: 5px 0px;
  &.green {
    border: 4px solid var(--green);
    color: var(--blue);
    &:before {
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      width: 0%;
      height: 100%;
      background: var(--green);
      z-index: -1;
      transition: 0.2s ease;
    }
    &:hover {
      color: var(--white);
      background: var(--green);
      transition: 0.2s ease;
      &:before {
        width: 100%;
      }
    }
  }
}
@media screen and (max-width:768px) {
  body {
    display:block;
  }
  .container {
    margin-top:70px;
    margin-bottom:70px;
  }
} 
	</style>

	<script src="{{asset('assets/js/gsap.min.js')}}" type="text/javascript">
		
	</script>
</head>




<body>

<main>
  <div class="container">
    <div class="row">
      <div class="col-md-6 align-self-center">
        
      </div>
      <div class="col-md-8 align-self-center">

        <div>
    <p style="float: left;"><img style="height: 140px; padding-top: 5px" src="{{ asset('assets/img/dbl2.png') }}" alt=""></p>
    <h1>404</h1>
      </div>
        <!-- <h1>404<img style="height: 140px; padding-top: 5px" src="{{ asset('assets/img/dbl2.png') }}" alt=""></h1> -->
        <br>
        <h2>The page you are looking for does not exist.</h2>
        
        <a href="{{ route('check') }}"><button class="btn bg-green">PREVIOUS</button></a>
        
      </div>
    </div>
  </div>
</main>
</body>

<script type="text/javascript">
	gsap.set("svg", { visibility: "visible" });
gsap.to("#headStripe", {
  y: 0.5,
  rotation: 1,
  yoyo: true,
  repeat: -1,
  ease: "sine.inOut",
  duration: 1
});
gsap.to("#spaceman", {
  y: 0.5,
  rotation: 1,
  yoyo: true,
  repeat: -1,
  ease: "sine.inOut",
  duration: 1
});
gsap.to("#craterSmall", {
  x: -3,
  yoyo: true,
  repeat: -1,
  duration: 1,
  ease: "sine.inOut"
});
gsap.to("#craterBig", {
  x: 3,
  yoyo: true,
  repeat: -1,
  duration: 1,
  ease: "sine.inOut"
});
gsap.to("#planet", {
  rotation: -2,
  yoyo: true,
  repeat: -1,
  duration: 1,
  ease: "sine.inOut",
  transformOrigin: "50% 50%"
});

gsap.to("#starsBig g", {
  rotation: "random(-30,30)",
  transformOrigin: "50% 50%",
  yoyo: true,
  repeat: -1,
  ease: "sine.inOut"
});
gsap.fromTo(
  "#starsSmall g",
  { scale: 0, transformOrigin: "50% 50%" },
  { scale: 1, transformOrigin: "50% 50%", yoyo: true, repeat: -1, stagger: 0.1 }
);
gsap.to("#circlesSmall circle", {
  y: -4,
  yoyo: true,
  duration: 1,
  ease: "sine.inOut",
  repeat: -1
});
gsap.to("#circlesBig circle", {
  y: -2,
  yoyo: true,
  duration: 1,
  ease: "sine.inOut",
  repeat: -1
});

gsap.set("#glassShine", { x: -68 });

gsap.to("#glassShine", {
  x: 80,
  duration: 2,
  rotation: -30,
  ease: "expo.inOut",
  transformOrigin: "50% 50%",
  repeat: -1,
  repeatDelay: 8,
  delay: 2
});

const burger = document.querySelector('.burger');
const nav = document.querySelector('nav');

burger.addEventListener('click',(e) => {
  burger.dataset.state === 'closed' ? burger.dataset.state = "open" : burger.dataset.state = "closed"
  nav.dataset.state === "closed" ? nav.dataset.state = "open" : nav.dataset.state = "closed"
})
</script>
</html>