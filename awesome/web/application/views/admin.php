
<div class="page">
    <div class="inner white-box">
	
	<h2>Timeslots</h2><br>
	once created the timeslots can only be disabled and cannot be changed, this is for record keeping, old bookings will still refer to a timeslot by its id, so updating a record will change all old bookings. this will also prevent errors in current bookings. 
	<table id="table-timeslots">
		<tr>
			<th>start</th>
			<th>finish</th>
			<th>peak</th>
			<th></th>
		</tr>
		<tr>
		<form id="form-timeslots-insert" >
			<td><input id="timeslots-insert-start" type="time" name="start" min="00:00:00" max="24:00:00"value="00:00:00"></input></td>
			<td><input id="timeslots-insert-finish" type="time" name="finish" min="00:00:00" max="24:00:00" value="00:00:00"></input></td>
			<td><input id="timeslots-insert-peak" type="checkbox" name="peak"></input></td>
			<td><button type="submit">Submit</button></td>
		</form>
		</tr>
	</table>
	
	<h2>Activities</h2><br>
	once created the activities can only be disabled and cannot be changed, this is for record keeping, old bookings will still refer to a activities by its id, so updating a record will change all old bookings. this will also prevent errors in current bookings. 
	<table id="table-activities">
		<tr>
			<th>name</th>
			<th>description</th>
			<th></th>
		</tr>
		<tr>
		<form id="form-activities-insert" >
			<td><input id="activities-insert-name" ></input></td>
			<td><textarea id="activities-insert-description" placeholder="activity description."></textarea></td>
			<td><button type="submit">Submit</button></td>
		</form>
		</tr>
	</table>
	
	<h2>Locations</h2><br>
	once created the location can only be disabled and cannot be changed, this is for record keeping, old bookings will still refer to a location by its id, so updating a record will change all old bookings. this will also prevent errors in current bookings. 
	<table id="table-location">
		<tr>
			<th>site</th>
			<th>area</th>
			<th>capacity</th>
			<th></th>
		</tr>
		<tr>
		<form id="form-location-insert" >
			<td><input id="location-insert-site" placeholder="Site"></input></td>
			<td><input id="location-insert-area" placeholder="area"></input></td>
			<td><input id="location-insert-capacity" type="number" placeholder="capacity"></input></td>
			<td><button type="submit">Submit</button></td>
		</form>
		</tr>
	</table>
	
	<h2>Timetable</h2><br>
	
	<table id="table-timetable">
		<tr>
			<th>day</th>
			<th>time slot</th>
			<th>activity</th>
			<th>site-area</th>
			<th>valid from</th>
			<th>valid till</th>
			<th></th>
		</tr>
		<tr>
		<form id="form-timetable-insert" >
			<td><select id="timetable-insert-day">
  <option value="1">Monday</option>
  <option value="2">Tuesday</option>
  <option value="3">Wednesday</option>
  <option value="4">Thursday</option>
  <option value="5">Friday</option>
  <option value="6">Saturday</option>
  <option value="0">Sunday</option>
  </select></td>
			<td><select id="timetable-insert-timeslot"></select></td>
			<td><select id="timetable-insert-activity"></select></td>
			<td><select id="timetable-insert-location"></select></td>
			<td><input type="text" id="timetable-insert-valid_from"></input></td>
			<td><input type="text" id="timetable-insert-valid_till"></input></td>
			<td><button type="submit">Submit</button></td>
		</form>
		</tr>
	
	</table>
	
</div>
</div>
