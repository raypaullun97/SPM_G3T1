<span id="countdown" class="timer"></span>
<script>

var minutes = 90;

   var seconds = minutes * 60;
   function secondPassed() {
   var minutes = Math.round((seconds - 30)/60);
   var remainingSeconds = seconds % 60;
   if (remainingSeconds < 10) {
      remainingSeconds = "0" + remainingSeconds; 
   }
   document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
   if (seconds == 0) {
    clearInterval(countdownTimer);
    document.getElementById('countdown').innerHTML = "Buzz Buzz";
   } else {
    seconds--;
   }
   }
   var countdownTimer = setInterval('secondPassed()', 1000);
</script>