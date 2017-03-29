
<div class="page">
    <div class="inner white-box">
    	<div id="booking-container">
            
            <h2>Booking Form</h2>
			<div id="price"></div>
        	<div class="indent">
            
            <h3>Activity</h3>
            <form id="form-activity"class="">
                <span id="response"></span><br> 
                Location: <select id="locations"></select>
                Area: <select id="area"></select>
                Date: <input type="text" id="datepicker">
                <!--<input id="submit" class="green-submit" type="submit" value="Submit">-->
                <div class="clear"></div>
                </form>
                <form id="activity">
                <table id='activity_table' >
                <tr id="headers">
                <th>Activity</th>
                <th>Time</th>
                <th>Capacity</th>
                <th>Select</th>
                <th></th>
                </tr>
                </table>
            </form>
        
            
            <h3>Extras</h3>
            <p>
            It is required that you use our gripy socks when on our trampolines this is for your saftey and others. If you have already been there is no need to re-purchase.
            </p>
            <form id="form-extras"class="">
                
                <table id='extras_table' >
                <tr id="headers">
                <th>Item</th>
                <th>Cost</th>
                <th>Quantity</th>
                </tr>
                </table>
                <div class="clear"></div>
            </form>
            
        <textarea id="notes" name="" placeholder="Additional notes"></textarea>
        
            <h3>Attendees</h3>
            <p>
            The details provided here are required for us to send your guests their waivers to agree to, which is a legal requirment for you to partake in the activities we provide. <a href="#">see more here</a>
            </p>
			<table id='waiver_table' >
                <tr id="headers">
                <th>firstname</th>
                <th>last name</th>
                <th>email</th>
                <th></th>
                </tr>
				<tr>
            <form id="form-waiver"class="">
                <td><input type="text" class="waiver" id="waiver-firstname" placeholder="First name"></input> </td>
                <td><input type="text" class="waiver" id="waiver-lastname" placeholder="Last name"></input></td>
                <td><input type="text" class="waiver" id="waiver-email" placeholder="Email"></input></td>
                <td><input type="submit" class="green-submit" id="submit" value="add"></input></td>
                <div class="clear"></div>
            </form>
			</tr>
                </table>
				<br>
                <button id="done" class="right black-submit" >SUBMIT</button>
				
            </div>
    	</div><!--booking-container-->
    </div><!--inner white-box-->
</div><!--page-->
