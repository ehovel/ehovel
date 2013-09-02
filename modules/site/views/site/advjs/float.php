function PCMSAD(PID) {
  this.ID        = PID;
  this.PosID  = 0; 
  this.ADID		  = 0;
  this.ADType	  = "";
  this.ADName	  = "";
  this.ADContent = "";
  this.PaddingLeft = 0;
  this.PaddingTop  = 0;
  this.Width = 0;
  this.Height = 0;
  this.IsHitCount = "N";
  this.UploadFilePath = "";
  
  this.Step = 1;
  this.Delay= 20;
  this.WindowHeight = 0;
  this.WindowWidth = 0;
  this.Yon = 0;
  this.Xon = 0;
  this.Pause = true;
  this.Interval = null;
  this.URL = "";
  this.SiteID = 0;
  
  this.ShowAD  = showADContent;
  this.Start   = doStart;
  this.Stat = statAD;
}

function statAD() {
	var new_element = document.createElement("script"); 
	new_element.type = "text/javascript";
	new_element.src="/site_ads/show_poster?type="+this.ADType+"&spaceid="+this.PosID+"&id="+this.ADID;
	document.body.appendChild(new_element);
}

function showADContent() {
  var content = this.ADContent;
  var str = "<div id='PCMSAD_"+this.PosID+"' style='left:"+this.PaddingLeft+"px;top:"+this.PaddingTop+"px;width:"+this.Width+"px; height:"+this.Height+"px; position: absolute;visibility: visible;z-index:999999;' onMouseOver='"+this.ID+"_pause_resume();' onMouseOut='"+this.ID+"_pause_resume();'>";
  var AD = eval('('+content+')');
  if (this.ADType == "images") {
	  if (AD.Images[0].imgADLinkUrl) str += "<a href='"+AD.Images[0].imgADLinkUrl+"' target='_blank'>";
	  str += "<img title='"+AD.Images[0].imgADAlt+"' src='"+this.UploadFilePath+AD.Images[0].ImgPath+"' width='"+this.Width+"' height='"+this.Height+"' style='border:0px;'>";
	  if (AD.Images[0].imgADLinkUrl) str += "</a>";
  }else if(this.ADType == "flash"){
	  str += "<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='"+this.Width+"' height='"+this.Height+"' id='FlashAD_"+this.PosID+"' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0'>";
	  str += "<param name='movie' value='"+this.UploadFilePath+AD.Images[0].ImgPath+"' />"; 
      str += "<param name='quality' value='autohigh' />";
      str += "<param name='wmode' value='opaque'/>";
	  str += "<embed wmode='opaque' src='"+this.UploadFilePath+AD.Images[0].ImgPath+"' quality='autohigh' name='flashad' swliveconnect='TRUE' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='"+this.Width+"' height='"+this.Height+"'></embed>";
      str += "</object>";	  
  }
  str += "<div style='text-align:right;'><a href='#;' onclick='javascript:document.getElementById(\"ZCMSAD_"+this.PosID+"\").style.display=\"none\"'>关闭</a></div>";
  str += "</div>";
  document.write(str);
}

function changePos(float) {	
	float.WindowWidth  = document.compatMode == "BackCompat" ? document.body.clientWidth : document.documentElement.clientWidth;
	float.WindowHeight = document.compatMode == "BackCompat" ? document.body.clientHeight : document.documentElement.clientHeight;
	document.getElementById("PCMSAD_"+float.PosID).style.left = (float.PaddingLeft + (Math.max(document.documentElement.scrollLeft, document.body.scrollLeft)))+"px";
	document.getElementById("PCMSAD_"+float.PosID).style.top = (float.PaddingTop + (Math.max(document.documentElement.scrollTop, document.body.scrollTop)))+"px";
	if (float.Yon){
		float.PaddingTop = float.PaddingTop + float.Step;
	}else{
		float.PaddingTop = float.PaddingTop - float.Step;
	}
	if (float.PaddingTop < 0){
		float.Yon = 1;
		float.PaddingTop = 0;
	}
	if (float.PaddingTop >= (float.WindowHeight - float.Height)){
		float.Yon = 0;float.PaddingTop = (float.WindowHeight - float.Height);
	}
	if (float.Xon){
		float.PaddingLeft = float.PaddingLeft + float.Step;
	}else{
		float.PaddingLeft = float.PaddingLeft - float.Step;
	}
	if (float.PaddingLeft < 0){
		float.Xon = 1;
		float.PaddingLeft = 0;
	}
	if (float.PaddingLeft >= (float.WindowWidth - float.Width)){
		float.Xon = 0;
		float.PaddingLeft = (float.WindowWidth - float.Width);   
	}
}
	
function doStart(float){
	return function(){
        changePos(float);
    }
}
 
function cmsAD_<?php echo $spaceid;?>_pause_resume(){if(cmsAD_<?php echo $spaceid;?>.Pause){clearInterval(cmsAD_<?php echo $spaceid;?>.Interval);cmsAD_<?php echo $spaceid;?>.Pause = false;}else {cmsAD_<?php echo $spaceid;?>.Interval = setInterval(cmsAD_<?php echo $spaceid;?>.Start(cmsAD_<?php echo $spaceid;?>),cmsAD_<?php echo $spaceid;?>.Delay);cmsAD_<?php echo $spaceid;?>.Pause = true;}} 
var cmsAD_<?php echo $spaceid;?> = new PCMSAD('cmsAD_<?php echo $spaceid;?>'); 
cmsAD_<?php echo $spaceid;?>.PosID = <?php echo $spaceid;?>; 
cmsAD_<?php echo $spaceid;?>.ADID = <?php echo $id;?>; 
cmsAD_<?php echo $spaceid;?>.ADType = "<?php echo $type;?>"; 
cmsAD_<?php echo $spaceid;?>.ADName = "<?php echo $name;?>"; 
cmsAD_<?php echo $spaceid;?>.ADContent = "{'Images':[{'imgADLinkUrl':'<?php echo $linkurl;?>','imgADAlt':'<?php echo $alt;?>','ImgPath':'<?php echo $type=='images' ? $imageurl : $flashurl;?>'}],'imgADLinkTarget':'New','Count':'1','showAlt':'Y'}"; 
cmsAD_<?php echo $spaceid;?>.URL = ""; 
cmsAD_<?php echo $spaceid;?>.SiteID = <?php echo $spaceid;?>; 
cmsAD_<?php echo $spaceid;?>.PaddingLeft = <?php if($paddleft){ echo $paddleft;}else{echo 0;} ?>; 
cmsAD_<?php echo $spaceid;?>.PaddingTop = <?php if($paddtop){ echo $paddtop;}else{echo 0;} ?>; 
cmsAD_<?php echo $spaceid;?>.Width = <?php if(!empty($width)){echo $width;}else{?> "" <?php }?>; 
cmsAD_<?php echo $spaceid;?>.Height = <?php if(!empty($height)){echo $height;}else{?> "" <?php }?>;
cmsAD_<?php echo $spaceid;?>.UploadFilePath = ""; 
cmsAD_<?php echo $spaceid;?>.ShowAD();

var isIE=!!window.ActiveXObject; 
if (isIE){

	if (document.readyState=="complete"){
		cmsAD_<?php echo $spaceid;?>.Stat();
	} else {
		document.onreadystatechange=function(){
			if(document.readyState=="complete") cmsAD_<?php echo $spaceid;?>.Stat();
		}
	}
} else {
	cmsAD_<?php echo $spaceid;?>.Stat();
}
document.getElementById('PCMSAD_<?php echo $spaceid;?>').visibility = 'visible';
cmsAD_<?php echo $spaceid;?>.Interval = setInterval(cmsAD_<?php echo $spaceid;?>.Start(cmsAD_<?php echo $spaceid;?>),cmsAD_<?php echo $spaceid;?>.Delay);