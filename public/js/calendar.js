// var date = new Date()
function generateDay(){
  let calendar           = document.getElementById("day")
      calendar.innerHTML = ""
  let month              = document.getElementById("month")
  let year_m             = document.getElementById("year_m")
  let day_m              = document.getElementById("day_m")
      month.innerHTML    = ""
  let date               = new Date()
  let day_now            = date.getDate()
  let month_now          = date.getMonth()
  let year_now           = date.getFullYear()
  let n                  = daysInMonth(month_now+1, year_now)

  let day = [n]
  const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];


  
  for(let i = 1; i <= n; i++){
    day[i] = document.createElement('div')
    day_content = document.createTextNode(i)
    day[i].appendChild(day_content)
    day[i].id = "day-" + i
    calendar.appendChild(day[i])
  }
  month.innerHTML = monthNames[month_now];
  day_m.innerHTML = day_now;
  year_m.innerHTML = year_now;

  for(let i = 1; i <= n; i++){
    let id_day = "day-"+i
    let today = document.getElementById(id_day)
    let today_number = today.innerHTML;
    if( day_now == today_number){
      today.id = "today";
    }
  }


}
// function setMonthUp() {
//   let currentMonth = date.getMonth()
//   if(currentMonth < 12)
//     currentMonth += 1;
//   generateDay();
//   generateTime();
// }
// function setMonthDown() {
//   // let date = new Date()
//   let currentMonth = date.getMonth()
//   if(currentMonth > 1)
//     currentMonth -= 1;
//   generateDay();
//   generateTime();
// }
function checkTime(t){
  if(t < 10) t =  "0" + t;
  return t
}
function generateTime(){
  // time.innerHTML = "";
  const days = ["Sunday", "Monday", "Tuesday", "Wenesday", "Thusday","Friday", "Saturday"]
  let date = new Date()
  let time     = document.getElementById("time")
  let hours    = date.getHours()
  let minutes  = date.getMinutes()
  let seconds  = date.getSeconds()
  let day_week = days[date.getDay()]

  hours = checkTime(hours)
  minutes = checkTime(minutes)
  seconds = checkTime(seconds)

  time.innerHTML = day_week +" - "+ hours + ":" + minutes + ":" + seconds;
  var t = setTimeout(generateTime, 500);
}
function daysInMonth (month, year) { 
  return new Date(year, month, 0).getDate(); 
} 

