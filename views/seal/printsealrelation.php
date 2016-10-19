<?php
$this->layout = 'nolayout';
$app = \MapasCulturais\App::i();

/*
 * Mapas Culturais entity seal atributed printing.
 */
$entity = $relation->seal;
$period = new DateInterval("P" . $entity->validPeriod . "M");
$dateIni = $relation->createTimestamp->format("d/m/Y");
$dateFin = $relation->createTimestamp->add($period);
$dateFin = $dateFin->format("d/m/Y");

$msg = $relation->seal->certificateText;
$msg = str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp",$msg);
$msg = str_replace("[sealName]",$relation->seal->name,$msg);
$msg = str_replace("[sealOwner]",$relation->seal->agent->name,$msg);
$msg = str_replace("[sealShortDescription]",$relation->seal->shortDescription,$msg);
$msg = str_replace("[sealRelationLink]",$app->createUrl('seal','printsealrelation',[$relation->id]),$msg);
$msg = str_replace("[entityDefinition]",$relation->owner->entityType,$msg);
    $msg = str_replace("[entityName]",'<span class="entity-name">'.$relation->owner->name.'</span>',$msg);
$msg = str_replace("[dateIni]",$dateIni,$msg);
$msg = str_replace("[dateFin]",$dateFin,$msg);

?>
<div id="culturaviva-model">
    <p class="certificate-content"><?php echo nl2br($msg) ?></p>
    <div class="footer">
        <div class="entity-url">
            <a  href="<?php echo $relation->owner->getSingleUrl(); ?>"
                title="<?php echo $relation->owner->name ?>"><?php echo $relation->owner->getSingleUrl(); ?></a>
        </div>
        <div class="footer-signatures">
            <div class="certificate-seal-owner">
                <p><?php echo $relation->seal->agent->name; ?><br>
                <?php echo $relation->seal->agent->shortDescription; ?></p>
            </div>
            <div class="certificate-seal-avatar">
                <img src="<?php echo $relation->seal->getAvatar()->url; ?>"
                    alt="<?php echo $relation->seal->name ?>">
            </div>
            <div class="certificate-site-brand">
                <img src="<?php $this->asset('img/logo-site.png'); ?>"
                    alt="<?php $this->dict('site: name'); ?>">
            </div>
        </div>
    </div>
</div>
