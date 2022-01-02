import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

function CountDown() {

    const [dueDate, setDueDate] = useState(0);
    const [dateDiff, setDateDiff] = useState(0);
    const [count, setCount] = useState(0);
    const [hour, setHour] = useState(0);
    const [min, setMin] = useState(0);
    const [sec, setSec] = useState(0);
    const [times, setTimes] = useState(0);

    useEffect(()=>{
        let date = document.getElementById("due_date").value;
        date = new Date(date);

        let nowDate = new Date();

        let dateDiff =  date - nowDate;

        console.log("date is ");
        console.log(date);

        console.log("now date is ");
        console.log(nowDate);

        console.log("date diff is ");
        console.log(dateDiff);

        calculateTime(dateDiff);

        const interval = setInterval(() => {
            nowDate = new Date();
            dateDiff =  date - nowDate;
            calculateTime(dateDiff);
        }, 1000);

        setDueDate(date);
        setDateDiff(dateDiff);
    },count)



    function calculateTime(milliseconds){

        var seconds = milliseconds / 1000;
        
        var hours = parseInt( seconds / 3600 );
        seconds = seconds % 3600;

        var minutes = parseInt( seconds / 60 );
        seconds = seconds % 60;

        seconds=Math.floor(seconds);





        console.log("length of hours is ");
        console.log(hours)
        console.log("length of mins is ");
        console.log(minutes)
        console.log("length of seconds is ");
        console.log(seconds)

        console.log(seconds.toString().length);

        seconds.toString().length==1 ? seconds = "0"+seconds.toString() : ""
        minutes.toString().length==1 ? minutes = "0"+minutes.toString() : ""

        setHour(hours);
        setMin(minutes);
        setSec(seconds);

    }   

    return (
        <span>
            { `${hour}:${min}:${sec}` }
        </span>
    );
}

export default CountDown;

if (document.getElementById('projectCountDown')) {
    ReactDOM.render(<CountDown />, document.getElementById('projectCountDown'));
}
