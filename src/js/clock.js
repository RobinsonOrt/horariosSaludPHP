function loadClock(){
    var dateTime = new Date();
    var hour = dateTime.getHours(); 
    var minute = dateTime.getMinutes(); 
    var second = dateTime.getSeconds(); 
    
    let clock = hour + ":" + minute + ":" + second;
    document.getElementById("clock").innerText = clock;
    document.getElementById("clock").textContent = clock;
    setTimeout(loadClock, 500);
}
loadClock();
