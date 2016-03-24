<?php echo $this->Form->create('cepage'); ?>
<?php
echo $this->Form->input('label', array('name'=>"data[Origine][label]" ,'value' => $origine['Origine']['label']));
$devises = array('EUR'=>'EUR','USD' => 'USD', 'EUR' => 'EUR', 'ZAR' => 'ZAR','AUD'=>'AUD','BGN'=>'BGN','BRL'=>'BRL','CAD'=>'CAD','CHF'=>'CHF','CNY'=>'CNY','CZK'=>'CZK','DKK'=>'DKK','GBP'=>'GBP','HKD'=>'HKD','HRK'=>'HRK','HUF'=>'HUF','IDR'=>'IDR','ILS'=>'ILS','INR'=>'INR','JPY'=>'JPY','KRW'=>'KRW','MXN'=>'MXN','MYR'=>'MYR','NOK'=>'NOK','NZD'=>'NZD','PHP'=>'PHP','PLN'=>'PLN','RON'=>'RON','RUB'=>'RUB','SEK'=>'SEK','SGD'=>'SGD','THB'=>'THB','TRY'=>'TRY');
echo $this->Form->input('Devise', array('name'=>"data[Origine][devise]",'options' => $devises, 'default' => $origine['Origine']['devise']));

?>
<?php echo $this->Form->end('Sauvegarder'); ?>