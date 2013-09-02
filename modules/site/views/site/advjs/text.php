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
  this.URL = "";
  this.SiteID = 0;
  this.ShowAD  = showADContent;
  this.Stat = statAD;
}

function statAD(id) {
	var sp = document.createElement("SCRIPT");
	sp.type = "text/javascript";
	sp.src = "/site_ads/show_poster?type="+this.ADType+"&spaceid="+this.PosID+"&id="+this.ADID;
	document.body.appendChild(sp);
}

function showADContent() {
  var content = this.ADContent;
  var isIE=!!window.ActiveXObject;
  var str = "<div id='PCMSAD_"+this.PosID+"'>";
  var AD = eval('('+content+')');
  var count = 0;
  if(AD.ADText.length){
	  count = AD.ADText.length;
  }
  for(var i=0;i< count;i++){
	if (isIE){

		if (document.readyState=="complete"){
			this.Stat(AD.ADText[i].textID);
		} else {
			document.onreadystatechange=function(){
				if(document.readyState=="complete") this.Stat(AD.ADText[i].textID);
			}
		}
	} else {
		this.Stat(AD.ADText[i].textID);
	}
	  str += "<li><a href="+this.URL+" target='_blank' title='"+AD.ADText[i].textContent+"'>"+AD.ADText[i].textContent+"</a></li>";
	}
  str += "</div>";
  document.write(str);
}
 
var cmsAD_<?php echo $pinfo[0]->id;?> = new PCMSAD('cmsAD_<?php echo $pinfo[0]->id;?>'); 
cmsAD_<?php echo $pinfo[0]->id;?>.PosID = <?php echo $spaceid;?>; 
cmsAD_<?php echo $pinfo[0]->id;?>.ADID = <?php echo $id;?>; 
cmsAD_<?php echo $pinfo[0]->id;?>.ADType = "<?php echo $type;?>"; 
cmsAD_<?php echo $pinfo[0]->id;?>.ADName = "<?php echo $name;?>"; 
cmsAD_<?php echo $pinfo[0]->id;?>.ADContent = "{'ADText':[<?php foreach($pinfo as $p):?>{'textID':'<?php echo $p->id;?>','textContent':'<?php echo $p->title;?>','textLinkUrl':'<?php echo urlencode($p->linkurl);?>'} <?php if(count($pinfo) != 1):?>,<?php endif;?><?php endforeach;?>]}"; 
cmsAD_<?php echo $pinfo[0]->id;?>.URL = "/"; 
cmsAD_<?php echo $pinfo[0]->id;?>.SiteID = <?php echo $siteid;?>; 
cmsAD_<?php echo $pinfo[0]->id;?>.Width = <?php if(!empty($width)){echo $width;}else{?> "" <?php }?>; 
cmsAD_<?php echo $pinfo[0]->id;?>.Height = <?php if(!empty($height)){echo $height;}else{?> "" <?php }?>;
cmsAD_<?php echo $pinfo[0]->id;?>.UploadFilePath = ""; 
cmsAD_<?php echo $pinfo[0]->id;?>.ShowAD();
