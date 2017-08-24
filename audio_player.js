/*
Moddified by 
	Michael Sunday Ogundele
	6/20/07
	msogundele@gmail.com
    Purpose: To be able to play multiples playlist continuously. Improved the duration Time and current Time.
	
				THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
			IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
			FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
			AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
			LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
			OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
			THE SOFTWARE.       Version 1, 6/20/07
	
	
	
	Audio Folder Player
	by Freakk
	ffr3akk@gmail.com
	
	
	
*/


jQuery(document).ready(function($) {

var index = 0;
var max_songs = $('#playlist').attr('value');
var mute = false;
var vol = .6; /* css #vol_bar width should also be set at 60% */
var vol_bak = 1;
var countdown = false;
var mins = 0;
var secs = 0;
var loaded = 0;
var duration = 0;
var posirion = 0;

$('#title').html($('#song'+(index+1)).attr('name'));
/* CONTROL FUNCTIONS */
var play = function(){
    $('#playlist audio').get(index).play();
	$('#play').hide();
	$('#pause').show();
	$('#title').html($('#song'+(index+1)).attr('name'));
};
var pause = function(){
    $('#playlist audio').get(index).pause();
	$('#pause').hide();
	$('#play').show();
};
var stop = function(){
    $('#playlist audio').get(index).pause();
	$('#playlist audio').get(index).currentTime = 0;
	$('#pause').hide();
	$('#play').show();
};
var next = function(){
	//stop current song
    $('#playlist audio').get(index).pause();
	$('#playlist audio').get(index).currentTime = 0;  
   index++;
   if(index >= max_songs) index = 0;
   $('#playlist audio').get(index).play();
   $('#play').hide();
   $('#pause').show();
   $('#title').html($('#song'+(index+1)).attr('name'));
};
var prev = function(){
	//stop current song
    $('#playlist audio').get(index).pause();
	$('#playlist audio').get(index).currentTime = 0;   
   index--;
   if(index < 0) index = max_songs-1;
   $('#playlist audio').get(index).play();
   $('#play').hide();
   $('#pause').show();
   $('#title').html($('#song'+(index+1)).attr('name'));
};
var playSong = function(n){
	stop();
	index = n;
	play();
};
/* AUTOPLAY */
if( $('#player').attr('data-autoplay')=="1") play();

/* CONTROL BUTTONS */
$('#play').click(function()  { play(); });
$('#pause').click(function() { pause();});
$('#stop').click(function()  { stop(); });
$('#ffwd').click(function() {
    $('#playlist audio').get(index).currentTime += .5;
});
$('#fbwd').click(function() {
    $('#playlist audio').get(index).currentTime -= .5;
});
$('#next').click(function() { next(); });
$('#prev').click(function() { prev(); });
$('#timer').click(function() { 
	if(countdown) countdown=false;
	else countdown=true;
});
/* BIND PROCESS */
$("audio").bind('timeupdate', function(){
	duration = $('#playlist audio').get(index).duration;
	   /* get full duration time of the song */
	  eta = duration;
	  mins0 = parseInt( eta / 60);
	  secs0 = parseInt( eta - mins0 * 60);
	  
	position = $('#playlist audio').get(index).currentTime;
	loaded = $('#playlist audio').get(index).buffered.end($('#playlist audio').get(index).buffered.length-1);
		
	if(position >= duration){ next(); };

	if(countdown==false){
		mins = parseInt(position / 60);
		secs = parseInt(position - mins * 60);
		
	} else {
		eta = duration - position;
		mins = parseInt( eta / 60);
		secs = parseInt( eta - mins * 60);
		 
	}
	// double digit
	if(mins<10) mins = "0"+mins.toString();
	if(secs<10) secs = "0"+secs.toString();
	var widthOfBufferBar = Math.floor( 100 / duration * loaded);
    var widthOfProgressBar = Math.floor( 100 / duration * position);
    $('#progressbar').css({
        'width':widthOfProgressBar+'%'
    });
	$('#progressbar_buffer').css({
        'width':widthOfBufferBar+'%'
    });
	$('#timer').html( mins+":"+secs);
    $('#timer0').html( mins0+":"+secs0); 
	$('#playlist audio').get(index).volume = vol;
});

/* PROGRESS BAR */
$('#progressbar_container').click(function(e) {
	var offset = $(this).offset(); 
	pos =(100*(e.clientX - offset.left)/($('#progressbar_container').width() ));
	$('#playlist audio').get(index).currentTime = $('#playlist audio').get(index).duration*pos/100;  
});

/* MUTE */
$('#vol_on').click(function() {
	$('#vol_off').show();
	$(this).hide();
	vol_bak = vol;
	vol = 0;
	mute = true;
});
$('#vol_off').click(function() {
	$('#vol_on').show();
	$(this).hide();
	vol=vol_bak;
	mute = false;
});
/* VOLUME CONTROL */
$('#vol_bar_container').click(function(e) {
	var offset = $(this).offset(); 
	pos = parseInt(100*(e.clientX - offset.left)/($('#vol_bar_container').width() ));
	width = $('#vol_bar_container').attr('width');
	$('#vol_bar').css({'width':pos+'%'});
	if(mute){ vol_bak = pos/100; }
	else {vol = pos/100 };
});

/* PLAYLIST */
$('#playlist_display_btn').click(function() { 
	$('#playlist_container').fadeToggle('fast');
});
$('.song_name').click(function() { 
	playSong($(this).attr('value')-1); 
});
});
	