// <div id="processing" class="accordion">
                        // <div id="outFordelevery" class="accordion">
						// 	<div scope="row">
						// 			<?php
						// 			echo
						// 			"<button type='button' data-toggle='collapse' data-target='#collapse{$key}' aria-expanded='true' aria-controls='collapse{$key}' class='btn border border-dark rounded-circle'>
                        //                 +
                        //             </button>";
						// 			 echo $order[0]['user_name'];?>
                        //     </div>
							// <td> 
                            // <?php 
                            // echo $order[0]['state']; ?> 
						// 	</td>
                        // 	<td> <?php 
                        // echo $order[0]['total_price']; ?> 
						// 	</td>
						// 	<td><?php 
						// 		if ($order[0]['state']==0) {
						// 		echo "<a class='btn btn-danger' href='cancel.php/{$order[0]['order_id']}'>Cancel</a>";
						// 	}?></td>
                        //     </tr>
						// 	<?php
						// 	 echo " <tr  id='collapse{$key}' class='collapse' aria-labelledby='heading{$key}' data-parent='#accordion'>";?>
						// 	  <td colspan="4">
						// 			
									 
						// 			 foreach($order as $product){
						// 			   echo "<div class='card-body'>
						// 			   <p>{$product['product_name']}</p><br/>
						// 			   <p>{$product['product_amount']}</p>"
						// 			   ;
									   
						// 			   echo "</div>";	
						// 		   }?>
						// 		</td>
						// 	</tr>
                        //  <?php 
                    // } ?>
                         </script>

         <div id="container">
             <div id="processing">
                 <div class="image" data-number=2 style="background-color:red"></div>
                 <div class="image"  data-number=2 style="background-color:red"></div>
                 <div class="image"  data-number=2 style="background-color:red"></div>
                 <div class="image"  data-number=2 style="background-color:red"></div>
                 <div class="image"  data-number=2  style="background-color:red"></div>
                          <div class="image"  data-number=2 style="background-color:red"></div>
                 <div class="image"  data-number=2 src="UP/7.jpg"/> -->
                 <img class="image"   data-number=2 src="UP/8.jpg"/>
                <img class="image"  data-number=2 src="UP/9.jpg"/>
                 <img class="image"  data-number=2 src="UP/10.jpg"/>
                 <img class="image"  data-number=2 src="UP/11.jpg"/> -->
             </div>

             <div id="outFordelevery">

             </div>
             <div id="done">

             </div>
         </div>
         <!-- <script> -->
        //         // load event
        //     window.addEventListener('load', function () {
        //             // get top section
        //         processing = document.getElementById('processing');
        //             // get bottom section
        //         outFordelevery = document.getElementById('outFordelevery');
        //         done = document.getElementById('done');

        //             // get all images
        //         allimages = document.querySelectorAll('.image');
        //             // registeration
        //             // bottom => dragenter , dragover , drop
        //         outFordelevery.addEventListener('dragenter', enterdrag);
        //         outFordelevery.addEventListener('dragover', overdrag);
        //         outFordelevery.addEventListener('drop', dropped);
        //             // top => dragleave
        //         processing.addEventListener('dragleave', leavedrag);
        //             // images => drag start and drag end
        //         for(var i = 0 ; i < allimages.length;i++)
        //         {
        //             allimages[i].addEventListener('dragstart', startdrag);
        //             allimages[i].addEventListener('dragend', enddrag);
        //         }
        //     });
<!-- // <script> -->
//             function startdrag(e) {
//                     e.dataTransfer.setData('myimg', e.srcElement.outerHTML);
//                 }
//                 function enddrag(e) {
//                     e.preventDefault();
//                     e.target.setAttribute("data-number",parseInt(e.target.getAttribute("data-number"))-1+"");
//                     if(parseInt( e.target.getAttribute("data-number"))==0){
//                     e.target.style.display = 'none';}
                    
                    
//                 }
//                 function dropped(e) {
//                     e.preventDefault();
//                     //alert(e.dataTransfer.getData('myimg'));
//                     outFordelevery.innerHTML += e.dataTransfer.getData('myimg');
                   
//                 }
//                 function leavedrag(e) {
//                     e.preventDefault();
//                 }
//                 function enterdrag(e) {
//                     e.preventDefault();
//                     outFordelevery.style.backgroundColor = 'maroon';
//                 }
//                 function overdrag(e) {
//                     e.preventDefault();
//                 }
// if(state==0){
                //     let order= $("  
				// 					 foreach($order as $product){
				// 					   echo "<div class='card-body'>
				// 					   <p>{$product['product_name']}</p><br/>
				// 					   <p>{$product['product_amount']}</p>"
				// 					   ;
				// 					   echo '</div>';	
				// 				   }?>");
   
                // }