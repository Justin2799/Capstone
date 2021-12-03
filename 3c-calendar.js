var cal = {
  /*ajax call*/
  ajax: function (data, load) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "3d-ajax.php");
    if (load) {
      xhr.onload = load;
    }
    xhr.send(data);
  },

  /*on page load*/
  init: function () {
    document.getElementById("calmonth").addEventListener("change", cal.draw);
    document.getElementById("calyear").addEventListener("change", cal.draw);
    document.getElementById("calformdel").addEventListener("click", cal.del);
    document.getElementById("calform").addEventListener("submit", cal.save);
    document.getElementById("calformcx").addEventListener("click", cal.hide);
    cal.draw();
  },

  /*calendar*/
  draw: function () {
    /*form data*/
    let data = new FormData();
    data.append("req", "draw");
    data.append("month", document.getElementById("calmonth").value);
    data.append("year", document.getElementById("calyear").value);

    /*onclick event*/
    cal.ajax(data, function () {
      let wrapper = document.getElementById("calwrap");
      wrapper.innerHTML = this.response;
      let all = wrapper.getElementsByClassName('day');
      for (let day of all) {
        day.addEventListener("click", cal.show);
      }
      all = wrapper.getElementsByClassName('calevt');
      if (all.length != 0) {
        for (let evt of all) {
          evt.addEventListener("click", cal.show);
        }
      }
    });
  },

  /*show event*/
  show: function (evt) {
    let eid = this.getAttribute("data-eid");
    /*add event*/
    if (eid === null) {
      let year = document.getElementById("calyear").value,
        month = document.getElementById("calmonth").value,
        day = this.dataset.day;
      if (month.length == 1) {
        month = "0" + month;
      }
      if (day.length == 1) {
        day = "0" + day;
      }
      document.getElementById("calform").reset();
      document.getElementById("evtid").value = "";
      document.getElementById("evtstart").value = `${year}-${month}-${day}`;
      document.getElementById("evtend").value = `${year}-${month}-${day}`;
	 // document.getElementById("evttime").value = `${time}`;
      document.getElementById("calformdel").style.display = "none";
    }

    /*edit event*/
    else {
      let edata = JSON.parse(document.getElementById("evt" + eid).innerHTML);
      document.getElementById("evtid").value = eid;
      document.getElementById("evtstart").value = edata['evt_start'];
      document.getElementById("evtend").value = edata['evt_end'];
      document.getElementById("evttxt").value = edata['evt_text'];
      document.getElementById("evtcolor").value = edata['evt_color'];
	  document.getElementById("evttime").value = edata['evt_time'];
      document.getElementById("calformdel").style.display = "block";
    }

    /*show*/
    document.getElementById("calblock").classList.add("show");
    evt.stopPropagation();
  },

  /*hide*/
  hide: function () {
    document.getElementById("calblock").classList.remove("show");
  },

  /*save*/
  save: function (evt) {
    /*form data*/
    let data = new FormData(),
      eid = document.getElementById("evtid").value;
    data.append("req", "save");
    data.append("start", document.getElementById("evtstart").value);
    data.append("end", document.getElementById("evtend").value);
    data.append("txt", document.getElementById("evttxt").value);
    data.append("color", document.getElementById("evtcolor").value);
	data.append("time", document.getElementById("evttime").value);
    if (eid != "") {
      data.append("eid", eid);
    }

    /*ajax save*/
    cal.ajax(data, function () {
      if (this.response == "OK") {
        cal.hide();
        cal.draw();
      } else {
        alert(this.response);
      }
    });
    evt.preventDefault();
  },

  /*delete event*/
  del: function () {
    if (confirm("Delete Event?")) {
      // (G1) FORM DATA
      let data = new FormData();
      data.append("req", "del");
      data.append("eid", document.getElementById("evtid").value);

      /*ajax delete*/
      cal.ajax(data, function () {
        if (this.response == "OK") {
          cal.hide();
          cal.draw();
        } else {
          alert(this.response);
        }
      });
    }
  }
};
window.addEventListener("DOMContentLoaded", cal.init);
