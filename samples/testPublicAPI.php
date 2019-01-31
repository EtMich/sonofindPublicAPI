<?php

$url="http://dev.sonofind.com/mmd/";

if($_GET['trackcode']) {
    $trackcode=$_GET['trackcode'];
} else {
    $trackcode="SCD072005";
}

echo "<pre>SONOfind Public API test\n";
echo "Loading data for $trackcode\n";

$oXML = new SimpleXMLElement($url.$trackcode, NULL, TRUE);
#echo "NS".print_r($oXML-getNamespaces());

##ax_success = 1 --> everything OK
##ax_success = -1 --> errors occured and should be in ax_msg/ax_errmsg/ax_errcode
if($oXML->ax_success==-1) {
    $error = $oXML->ax_msg;
    $errormsg = $oXML->ax_errmsg;
    $errcode = (string) $oXML->ax_errcode;
    throw new Exception("XML Error on $trackcode\n\n".$result->ax_msg."\n",$errcode);
}

if((string) $oXML->ax_msg[0]) {
    echo "Response: ".$oXML->ax_msg[0]."\n\n";
}

## Direct XML node access
$XMLtrack=$oXML->track[0];
echo "Track found: ".$XMLtrack->trackcode[0]."\n";
echo "Track Title: ".$XMLtrack->titles[0]->title[0]."\n";

$oXML->registerXPathNamespace('mmd', 'http://www.musicmetadata.org/mmdSchema/');
## XPATH XML node access - as we use namespaces, the namespace is required for querying
$xPath="/mmd:mmd/mmd:track[@trackcode='$trackcode']/mmd:composers/mmd:composer[@type!='I']";
$xComposers = $oXML->xpath($xPath);

## Check for different types of composers at https://www.musicmetadata.org
foreach ($xComposers as $xComposer) {
    printf("Composer: %s IPI: %0d Type: %s \n",$xComposer[0],$xComposer['ipi'],$xComposer['type']);
}

$xPath="/mmd:mmd/mmd:track[@trackcode='$trackcode']/mmd:societies/mmd:society[@name='GEMA']";
$xGEMA = $oXML->xpath($xPath);
if(count($xGEMA)>0) {
    printf("GEMA Workcode: %s\n",$xGEMA[0][0]);
}

?>