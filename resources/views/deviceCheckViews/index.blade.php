<html>

  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <!-- <script src="jquery-2.1.4.js"></script> -->
  <script src="{{asset('js/mobile-detect-js/mobile-detect.js')}}"></script>
  
  </head>
  <body>
    <div id="vinit">
    <input type="text" name="name" id="name" v-model="name">
  <div id="navbar"><span>Mobile-detect.js</span></div>
  <div id="wrapper">
    <button id="detect-button">Detect Device</button>
    
  </div>
  </div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.14/vue.min.js"></script>
<script>
  var v = new Vue({
    el:'#vinit',
  data:{
    name:'',
  },
  methods:{},
  watch:{
    name:function(){
      console.log(this.name);
    }
  }
  });
  
</script>
  <script>

      $('#detect-button').click(function(){
            
            var detector = new MobileDetect(window.navigator.userAgent);

            console.log( "Mobile: " + detector.mobile());
            console.log( "Phone: " + detector.phone());
            console.log( "Tablet: " + detector.tablet());
            console.log( "OS: " + detector.os());
            console.log( "userAgent: " + detector.userAgent());
            
          });

  </script>
  </body>
</html>