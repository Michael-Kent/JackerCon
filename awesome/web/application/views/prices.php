
<div class="page">
    <div class="inner white-box">
		<h2>Prices</h2><br>
	<table>
	<tr>
		<form id="form-prices-insert" >
			<td>adult ticket price: <input type="text" id="prices-insert-adult"></input><br>
			child ticket price:<input type="text" id="prices-insert-child"></input><br>
			peak adult ticket price: <input type="text" id="prices-insert-adult-peak"></input><br>
			peak child ticket price:<input type="text" id="prices-insert-child-peak"></input><br>
			static price:<input type="text" id="prices-insert-static"></input><br>
			(if there is ticket prices static will be added after they are calculated)</td>
			<td><select id="prices-insert-condition">
				  <option value="activity">has activity</option>
				  <option value="peak_slots">amount of peak slots</option>
				  <option value="non_peak_slots">amount of non peak slots</option>
				  <option value="children_min">children_min</option>
				  <option value="children_max">children_max</option>
				  <option value="adult_min">adult_min</option>
				  <option value="adult_max">adult_max</option>
				  <option value="attendance_min">attendance_min</option>
				  <option value="attendance_max">attendance_max</option>
				  <option value="coupon_code">coupon_code</option>
			</select>
				<div id="condition-result">
					<select id="prices-insert-activity"></select>
					<select id="prices-insert-number">
						<?for($i = 0; $i < 20; ++$i) {?>
							<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select>
					<input type="text" id="prices-insert-condition-value"></input><br>
				</div>
  <button id='prices-insert-add-condition'>add condition</button>
	<div id="current-conditions"></div></td>
  
  
			<td>priority:
					<select id="prices-insert-priority">
						<?for($i = 0; $i < 20; ++$i) {?>
							<option value="<?=$i?>"><?=$i?></option>
						<?}?>
					</select><br>
			valid from:<input type="text" id="prices-insert-valid_from"></input>
			<br> valid till:<input type="text" id="prices-insert-valid_till"></input></td>
			<td><button type="submit">Submit</button></td>
		</form>
		</tr>
	
	</table>
	<table id="table-prices">
		<tr>
			<th>price</th>
			<th>conditions</th>
		</tr>
		<tr></tr>
	</table>
	
	
</div>
</div>
