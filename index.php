<!DOCTYPE html>     
<?php
 
?>

<html>     
    <head>      
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="audio_player.css">
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script> 
	<link rel="stylesheet" href="fonts/font-awesome-4.0.3/css/font-awesome.min.css">
</head>     

<body>     
<!--
	/*
Moddified by 
	Michael Sunday Ogundele
	6/20/07
	msogundele@gmail.com
    Purpose: To be able to play multiples playlist continuously. Improved the duration Time and current Time.
	Licenses: GNU GENERAL PUBLIC LICENSE
                       Version 2, June 1991

	
				
			    THIS SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
			IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
			FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
			AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
			LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
			OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
			THE SOFTWARE.         Version 1, 6/20/07
	        
	
	
	Audio Folder Player
	by Freakk
	ffr3akk@gmail.com
	
	
	
*/
-->
<div id="player" class="window" src="songs\Wish_You_Were_Here.mp3" data-autoplay="1" autoplay>
	<?php
	
	      //header('Content-Disposition: attachment; filename="media.mp3"');
           // header('Pragma: no-cache');		
		/* READ MP3 FILES FROM FOLDER */
		require_once("MP3/Id.php");
		$songs = "";
		$song_names = array();
		$categories = array();
		$allData=array();
		$i=0;
		foreach (glob("songs/*.mp3") as $filename) {
		$i++;
		 
        $file = $filename;
        $id3 = new MP3_Id();
        $id3->read($file);
        //print_r($id3);

        //echo $id3->getTag('artists');
		$filename_cut = substr ( $filename , strlen("songs/"));
		
			$noext = substr ( $filename_cut , 0, -4);
			$song_names[$i-1] = $noext;
			$categories[$i-1] = $id3->getTag('artists');
			$allData[$i-1] =  $noext. ',' .$id3->getTag('artists');
				
			
			$songs = $songs .'<audio id="song'.$i.'" src="songs/'.$filename_cut.'"  name="'.$noext.'"  category="'.$id3->getTag('artists').'" type="audio/mpeg"></audio>';
		}
	    
	 
		 
	?>
	<div id="playlist" value="<?php echo $i?>">
	<?php echo $songs?>
	</div> <!-- /#playlist -->
	<div id="display" class="display">
		<div id="timer" class="display_text">00:00</div>
		<div id="timer0" class="display_text0">00:00</div>
		
		<div id="title" class="display_text">- - - - - - - - - -</div>
		<div id="vol_container" class="display_text">
			<div id="vol_on" class="vol_icon"><i class="fa fa-volume-up"></i></div>
			<div id="vol_off" class="vol_icon"><i class="fa fa-volume-off"></i></div>
			<div id="vol_bar_container">
				<div id="vol_bar"></div>
			</div>
			<div id="playlist_display_btn">PL</div><!-- /#playlist_display_btn -->
		   
		</div><!-- /#vol_container -->
		 <div id="volumename" style="color:white;">Volume</div>
	</div> <!-- /#display -->
	<div id	="progressbar_container"><div id="progressbar_buffer"></div><div id="progressbar"></div></div>
	<div id="controls">
		<div class="ctrl_btn" id="prev"><i class="fa fa-fast-backward"></i></div>
		<div class="ctrl_btn" id="fbwd"><i class="fa fa-backward"></i></div>
		<div class="ctrl_btn" id="play"><i class="fa fa-play"></i></div>
		<div class="ctrl_btn" id="pause" style="display:none;"><i class="fa fa-pause"></i></div>
		<div class="ctrl_btn" id="stop"><i class="fa fa-stop"></i></div>
		<div class="ctrl_btn" id="ffwd"><i class="fa fa-forward"></i></div>
		<div class="ctrl_btn" id="next"><i class="fa fa-fast-forward"></i></div>
		<span class="stretch"></span>
	</div><!-- /#controls --> 
</div> <!-- /#player -->

<div id="playlist_container" class="window">
<div id="playlist_displayPop" class="displayPop"><div style="color:white;">Music 1 </div>
	 
	

	
	<?php
	 
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 
			  
				   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Pop')
							{
								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
				  
			   
		  
		
		function carryZero($n){
			if($n<10) return '0'.$n;
			else return $n;
		}
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayHiphop" class="displayHiphop"><div style="color:white;"> Music 2</div>
 
	
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 
			  
				   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Hop')
							{
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
//	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayCountry" class="displayCountry"><div style="color:white;">Music 3</div>
	
		 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 
			  
				   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Con')
							{
								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->

<div id="playlist_displayPop" class="displayPop"><div style="color:white;"> Music 4</div>
		 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 
			  
				   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Rag')
							{
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayHiphop" class="displayHiphop"><div style="color:white;">Music 5</div>
	
	 

	
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 
			  
				   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Asi')
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayCountry" class="displayCountry"><div style="color:white;">Music 6</div>
	 
	
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Rbs')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->

<div id="playlist_displayPop" class="displayPop"><div style="color:white;">Music 7</div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Djs')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayHiphop" class="displayHiphop"><div style="color:white;">Music 8</div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Lov')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayCountry" class="displayCountry"><div style="color:white;">Music 9</div>
	
	 
	
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Dec')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->

<div id="playlist_displayPop" class="displayPop"><div style="color:white;">Music 10</div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Afb')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayHiphop" class="displayHiphop"><div style="color:white;">Music 11</div>
   
	<?php
	$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Aft')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
	
	?>
	
	
</div><!-- /#playlist_display -->
<div id="playlist_displayCountry" class="displayCountry"><div style="color:white;">Music 12</div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Gos')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->

<div id="playlist_displayPop" class="displayPop"><div style="color:white;">Music 13</div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Jaz')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayHiphop" class="displayHiphop"><div style="color:white;">Music 14</div>
	 

	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Lat')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayCountry" class="displayCountry"><div style="color:white;"> Music 15</div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Edm')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->

<div id="playlist_displayPop" class="displayPop"><div style="color:white;">Music 16</div>
	 
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Tec')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayHiphop" class="displayHiphop"><div style="color:white;">Music 17</div>
	
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Kid')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
<div id="playlist_displayCountry" class="displayCountry"><div style="color:white;">Music 18</div>
	
	
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'Oth')			
							{								
								$cat = substr($category,0,-4);
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' :  '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->

<div id="playlist_displayTopTen" class="displayTopTen"><div style="color:white;">Top 10 </div>
	 
	
	<?php
		$j=0;
		$row_color[0] = "odd";
		$row_color[1] = "even";
		 			  			   
					    foreach ($allData as $name =>$category ) {
					    $j++;
						if (substr($category,-3) == 'T10')			
							{							
								$cat = substr($category,0,-4);
								
								echo('
									<div class="song_name '.$row_color[$j%2].'" value="'.$j.'">'.carryZero($j).' : '.$cat.'</div>
								');
							}
						 
				  }
		 
	?>
</div><!-- /#playlist_display -->
</div>
<script language="javascript" type="text/javascript" src="audio_player.js"></script>	 
</body>    
</html> 