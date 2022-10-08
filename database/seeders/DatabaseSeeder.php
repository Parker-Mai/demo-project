<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Areas;
use App\Models\Roles;
use App\Models\Orders;
use App\Models\Layouts;
use App\Models\Members;
use App\Models\Modules;
use App\Models\Accounts;
use App\Models\Articles;
use App\Models\Products;
use App\Models\Permissions;
use App\Models\SysSettings;
use App\Models\SitemapFrames;
use App\Models\MemberAddresses;
use App\Models\ModuleCategorys;
use App\Models\PermissionRoles;
use Illuminate\Database\Seeder;
use App\Models\FrameFieldsValue;
use App\Models\ProductCategorys;
use App\Models\FrameFieldsSetting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //縣市區域 START
            $lm_area = array(
            array('id' => '1','city' => '台北市','area' => '中正區','zipcode' => '100'),
            array('id' => '2','city' => '台北市','area' => '大同區','zipcode' => '103'),
            array('id' => '3','city' => '台北市','area' => '中山區','zipcode' => '104'),
            array('id' => '4','city' => '台北市','area' => '松山區','zipcode' => '105'),
            array('id' => '5','city' => '台北市','area' => '大安區','zipcode' => '106'),
            array('id' => '6','city' => '台北市','area' => '萬華區','zipcode' => '108'),
            array('id' => '7','city' => '台北市','area' => '信義區','zipcode' => '110'),
            array('id' => '8','city' => '台北市','area' => '士林區','zipcode' => '111'),
            array('id' => '9','city' => '台北市','area' => '北投區','zipcode' => '112'),
            array('id' => '10','city' => '台北市','area' => '內湖區','zipcode' => '114'),
            array('id' => '11','city' => '台北市','area' => '南港區','zipcode' => '115'),
            array('id' => '12','city' => '台北市','area' => '文山區','zipcode' => '116'),
            array('id' => '13','city' => '基隆市','area' => '仁愛區','zipcode' => '200'),
            array('id' => '14','city' => '基隆市','area' => '信義區','zipcode' => '201'),
            array('id' => '15','city' => '基隆市','area' => '中正區','zipcode' => '202'),
            array('id' => '16','city' => '基隆市','area' => '中山區','zipcode' => '203'),
            array('id' => '17','city' => '基隆市','area' => '安樂區','zipcode' => '204'),
            array('id' => '18','city' => '基隆市','area' => '暖暖區','zipcode' => '205'),
            array('id' => '19','city' => '基隆市','area' => '七堵區','zipcode' => '206'),
            array('id' => '20','city' => '新北市','area' => '萬里區','zipcode' => '207'),
            array('id' => '21','city' => '新北市','area' => '金山區','zipcode' => '208'),
            array('id' => '22','city' => '新北市','area' => '板橋區','zipcode' => '220'),
            array('id' => '23','city' => '新北市','area' => '汐止區','zipcode' => '221'),
            array('id' => '24','city' => '新北市','area' => '深坑區','zipcode' => '222'),
            array('id' => '25','city' => '新北市','area' => '石碇區','zipcode' => '223'),
            array('id' => '26','city' => '新北市','area' => '瑞芳區','zipcode' => '224'),
            array('id' => '27','city' => '新北市','area' => '平溪區','zipcode' => '226'),
            array('id' => '28','city' => '新北市','area' => '雙溪區','zipcode' => '227'),
            array('id' => '29','city' => '新北市','area' => '貢寮區','zipcode' => '228'),
            array('id' => '30','city' => '新北市','area' => '新店區','zipcode' => '231'),
            array('id' => '31','city' => '新北市','area' => '坪林區','zipcode' => '232'),
            array('id' => '32','city' => '新北市','area' => '烏來區','zipcode' => '233'),
            array('id' => '33','city' => '新北市','area' => '永和區','zipcode' => '234'),
            array('id' => '34','city' => '新北市','area' => '中和區','zipcode' => '235'),
            array('id' => '35','city' => '新北市','area' => '土城區','zipcode' => '236'),
            array('id' => '36','city' => '新北市','area' => '三峽區','zipcode' => '237'),
            array('id' => '37','city' => '新北市','area' => '樹林區','zipcode' => '238'),
            array('id' => '38','city' => '新北市','area' => '鶯歌區','zipcode' => '239'),
            array('id' => '39','city' => '新北市','area' => '三重區','zipcode' => '241'),
            array('id' => '40','city' => '新北市','area' => '新莊區','zipcode' => '242'),
            array('id' => '41','city' => '新北市','area' => '泰山區','zipcode' => '243'),
            array('id' => '42','city' => '新北市','area' => '林口區','zipcode' => '244'),
            array('id' => '43','city' => '新北市','area' => '蘆洲區','zipcode' => '247'),
            array('id' => '44','city' => '新北市','area' => '五股區','zipcode' => '248'),
            array('id' => '45','city' => '新北市','area' => '八里區','zipcode' => '249'),
            array('id' => '46','city' => '新北市','area' => '淡水區','zipcode' => '251'),
            array('id' => '47','city' => '新北市','area' => '三芝區','zipcode' => '252'),
            array('id' => '48','city' => '新北市','area' => '石門區','zipcode' => '253'),
            array('id' => '49','city' => '宜蘭縣','area' => '宜蘭市','zipcode' => '260'),
            array('id' => '50','city' => '宜蘭縣','area' => '頭城鎮','zipcode' => '261'),
            array('id' => '51','city' => '宜蘭縣','area' => '礁溪鄉','zipcode' => '262'),
            array('id' => '52','city' => '宜蘭縣','area' => '壯圍鄉','zipcode' => '263'),
            array('id' => '53','city' => '宜蘭縣','area' => '員山鄉','zipcode' => '264'),
            array('id' => '54','city' => '宜蘭縣','area' => '羅東鎮','zipcode' => '265'),
            array('id' => '55','city' => '宜蘭縣','area' => '三星鄉','zipcode' => '266'),
            array('id' => '56','city' => '宜蘭縣','area' => '大同鄉','zipcode' => '267'),
            array('id' => '57','city' => '宜蘭縣','area' => '五結鄉','zipcode' => '268'),
            array('id' => '58','city' => '宜蘭縣','area' => '冬山鄉','zipcode' => '269'),
            array('id' => '59','city' => '宜蘭縣','area' => '蘇澳鎮','zipcode' => '270'),
            array('id' => '60','city' => '宜蘭縣','area' => '南澳鄉','zipcode' => '272'),
            array('id' => '61','city' => '宜蘭縣','area' => '釣魚台列嶼','zipcode' => '290'),
            array('id' => '62','city' => '新竹市','area' => '北區','zipcode' => '300'),
            array('id' => '63','city' => '新竹縣','area' => '竹北市','zipcode' => '302'),
            array('id' => '64','city' => '新竹縣','area' => '湖口鄉','zipcode' => '303'),
            array('id' => '65','city' => '新竹縣','area' => '新豐鄉','zipcode' => '304'),
            array('id' => '66','city' => '新竹縣','area' => '新埔鎮','zipcode' => '305'),
            array('id' => '67','city' => '新竹縣','area' => '關西鎮','zipcode' => '306'),
            array('id' => '68','city' => '新竹縣','area' => '芎林鄉','zipcode' => '307'),
            array('id' => '69','city' => '新竹縣','area' => '寶山鄉','zipcode' => '308'),
            array('id' => '70','city' => '新竹縣','area' => '竹東鎮','zipcode' => '310'),
            array('id' => '71','city' => '新竹縣','area' => '五峰鄉','zipcode' => '311'),
            array('id' => '72','city' => '新竹縣','area' => '橫山鄉','zipcode' => '312'),
            array('id' => '73','city' => '新竹縣','area' => '尖石鄉','zipcode' => '313'),
            array('id' => '74','city' => '新竹縣','area' => '北埔鄉','zipcode' => '314'),
            array('id' => '75','city' => '新竹縣','area' => '峨眉鄉','zipcode' => '315'),
            array('id' => '76','city' => '桃園市','area' => '中壢區','zipcode' => '320'),
            array('id' => '77','city' => '桃園市','area' => '平鎮區','zipcode' => '324'),
            array('id' => '78','city' => '桃園市','area' => '龍潭區','zipcode' => '325'),
            array('id' => '79','city' => '桃園市','area' => '楊梅區','zipcode' => '326'),
            array('id' => '80','city' => '桃園市','area' => '新屋區','zipcode' => '327'),
            array('id' => '81','city' => '桃園市','area' => '觀音區','zipcode' => '328'),
            array('id' => '82','city' => '桃園市','area' => '桃園區','zipcode' => '330'),
            array('id' => '83','city' => '桃園市','area' => '龜山區','zipcode' => '333'),
            array('id' => '84','city' => '桃園市','area' => '八德區','zipcode' => '334'),
            array('id' => '85','city' => '桃園市','area' => '大溪區','zipcode' => '335'),
            array('id' => '86','city' => '桃園市','area' => '復興區','zipcode' => '336'),
            array('id' => '87','city' => '桃園市','area' => '大園區','zipcode' => '337'),
            array('id' => '88','city' => '桃園市','area' => '蘆竹區','zipcode' => '338'),
            array('id' => '89','city' => '苗栗縣','area' => '竹南鎮','zipcode' => '350'),
            array('id' => '90','city' => '苗栗縣','area' => '頭份鎮','zipcode' => '351'),
            array('id' => '91','city' => '苗栗縣','area' => '三灣鄉','zipcode' => '352'),
            array('id' => '92','city' => '苗栗縣','area' => '南庄鄉','zipcode' => '353'),
            array('id' => '93','city' => '苗栗縣','area' => '獅潭鄉','zipcode' => '354'),
            array('id' => '94','city' => '苗栗縣','area' => '後龍鎮','zipcode' => '356'),
            array('id' => '95','city' => '苗栗縣','area' => '通霄鎮','zipcode' => '357'),
            array('id' => '96','city' => '苗栗縣','area' => '苑裡鎮','zipcode' => '358'),
            array('id' => '97','city' => '苗栗縣','area' => '苗栗市','zipcode' => '360'),
            array('id' => '98','city' => '苗栗縣','area' => '造橋鄉','zipcode' => '361'),
            array('id' => '99','city' => '苗栗縣','area' => '頭屋鄉','zipcode' => '362'),
            array('id' => '100','city' => '苗栗縣','area' => '公館鄉','zipcode' => '363'),
            array('id' => '101','city' => '苗栗縣','area' => '大湖鄉','zipcode' => '364'),
            array('id' => '102','city' => '苗栗縣','area' => '泰安鄉','zipcode' => '365'),
            array('id' => '103','city' => '苗栗縣','area' => '銅鑼鄉','zipcode' => '366'),
            array('id' => '104','city' => '苗栗縣','area' => '三義鄉','zipcode' => '367'),
            array('id' => '105','city' => '苗栗縣','area' => '西湖鄉','zipcode' => '368'),
            array('id' => '106','city' => '苗栗縣','area' => '卓蘭鎮','zipcode' => '369'),
            array('id' => '107','city' => '台中市','area' => '中區','zipcode' => '400'),
            array('id' => '108','city' => '台中市','area' => '東區','zipcode' => '401'),
            array('id' => '109','city' => '台中市','area' => '南區','zipcode' => '402'),
            array('id' => '110','city' => '台中市','area' => '西區','zipcode' => '403'),
            array('id' => '111','city' => '台中市','area' => '北區','zipcode' => '404'),
            array('id' => '112','city' => '台中市','area' => '北屯區','zipcode' => '406'),
            array('id' => '113','city' => '台中市','area' => '西屯區','zipcode' => '407'),
            array('id' => '114','city' => '台中市','area' => '南屯區','zipcode' => '408'),
            array('id' => '115','city' => '台中市','area' => '太平區','zipcode' => '411'),
            array('id' => '116','city' => '台中市','area' => '大里區','zipcode' => '412'),
            array('id' => '117','city' => '台中市','area' => '霧峰區','zipcode' => '413'),
            array('id' => '118','city' => '台中市','area' => '烏日區','zipcode' => '414'),
            array('id' => '119','city' => '台中市','area' => '豐原區','zipcode' => '420'),
            array('id' => '120','city' => '台中市','area' => '后里區','zipcode' => '421'),
            array('id' => '121','city' => '台中市','area' => '石岡區','zipcode' => '422'),
            array('id' => '122','city' => '台中市','area' => '東勢區','zipcode' => '423'),
            array('id' => '123','city' => '台中市','area' => '和平區','zipcode' => '424'),
            array('id' => '124','city' => '台中市','area' => '新社區','zipcode' => '426'),
            array('id' => '125','city' => '台中市','area' => '潭子區','zipcode' => '427'),
            array('id' => '126','city' => '台中市','area' => '大雅區','zipcode' => '428'),
            array('id' => '127','city' => '台中市','area' => '神岡區','zipcode' => '429'),
            array('id' => '128','city' => '台中市','area' => '大肚區','zipcode' => '432'),
            array('id' => '129','city' => '台中市','area' => '沙鹿區','zipcode' => '433'),
            array('id' => '130','city' => '台中市','area' => '龍井區','zipcode' => '434'),
            array('id' => '131','city' => '台中市','area' => '梧棲區','zipcode' => '435'),
            array('id' => '132','city' => '台中市','area' => '清水區','zipcode' => '436'),
            array('id' => '133','city' => '台中市','area' => '大甲區','zipcode' => '437'),
            array('id' => '134','city' => '台中市','area' => '外埔區','zipcode' => '438'),
            array('id' => '135','city' => '台中市','area' => '大安區','zipcode' => '439'),
            array('id' => '136','city' => '彰化縣','area' => '彰化市','zipcode' => '500'),
            array('id' => '137','city' => '彰化縣','area' => '芬園鄉','zipcode' => '502'),
            array('id' => '138','city' => '彰化縣','area' => '花壇鄉','zipcode' => '503'),
            array('id' => '139','city' => '彰化縣','area' => '秀水鄉','zipcode' => '504'),
            array('id' => '140','city' => '彰化縣','area' => '鹿港鎮','zipcode' => '505'),
            array('id' => '141','city' => '彰化縣','area' => '福興鄉','zipcode' => '506'),
            array('id' => '142','city' => '彰化縣','area' => '線西鄉','zipcode' => '507'),
            array('id' => '143','city' => '彰化縣','area' => '和美鎮','zipcode' => '508'),
            array('id' => '144','city' => '彰化縣','area' => '伸港鄉','zipcode' => '509'),
            array('id' => '145','city' => '彰化縣','area' => '員林鎮','zipcode' => '510'),
            array('id' => '146','city' => '彰化縣','area' => '社頭鄉','zipcode' => '511'),
            array('id' => '147','city' => '彰化縣','area' => '永靖鄉','zipcode' => '512'),
            array('id' => '148','city' => '彰化縣','area' => '埔心鄉','zipcode' => '513'),
            array('id' => '149','city' => '彰化縣','area' => '溪湖鎮','zipcode' => '514'),
            array('id' => '150','city' => '彰化縣','area' => '大村鄉','zipcode' => '515'),
            array('id' => '151','city' => '彰化縣','area' => '埔鹽鄉','zipcode' => '516'),
            array('id' => '152','city' => '彰化縣','area' => '田中鎮','zipcode' => '520'),
            array('id' => '153','city' => '彰化縣','area' => '北斗鎮','zipcode' => '521'),
            array('id' => '154','city' => '彰化縣','area' => '田尾鄉','zipcode' => '522'),
            array('id' => '155','city' => '彰化縣','area' => '埤頭鄉','zipcode' => '523'),
            array('id' => '156','city' => '彰化縣','area' => '溪州鄉','zipcode' => '524'),
            array('id' => '157','city' => '彰化縣','area' => '竹塘鄉','zipcode' => '525'),
            array('id' => '158','city' => '彰化縣','area' => '二林鎮','zipcode' => '526'),
            array('id' => '159','city' => '彰化縣','area' => '大城鄉','zipcode' => '527'),
            array('id' => '160','city' => '彰化縣','area' => '芳苑鄉','zipcode' => '528'),
            array('id' => '161','city' => '彰化縣','area' => '二水鄉','zipcode' => '530'),
            array('id' => '162','city' => '南投縣','area' => '南投市','zipcode' => '540'),
            array('id' => '163','city' => '南投縣','area' => '中寮鄉','zipcode' => '541'),
            array('id' => '164','city' => '南投縣','area' => '草屯鎮','zipcode' => '542'),
            array('id' => '165','city' => '南投縣','area' => '國姓鄉','zipcode' => '544'),
            array('id' => '166','city' => '南投縣','area' => '埔里鎮','zipcode' => '545'),
            array('id' => '167','city' => '南投縣','area' => '仁愛鄉','zipcode' => '546'),
            array('id' => '168','city' => '南投縣','area' => '名間鄉','zipcode' => '551'),
            array('id' => '169','city' => '南投縣','area' => '集集鎮','zipcode' => '552'),
            array('id' => '170','city' => '南投縣','area' => '水里鄉','zipcode' => '553'),
            array('id' => '171','city' => '南投縣','area' => '魚池鄉','zipcode' => '555'),
            array('id' => '172','city' => '南投縣','area' => '信義鄉','zipcode' => '556'),
            array('id' => '173','city' => '南投縣','area' => '竹山鎮','zipcode' => '557'),
            array('id' => '174','city' => '南投縣','area' => '鹿谷鄉','zipcode' => '558'),
            array('id' => '175','city' => '雲林縣','area' => '斗南鎮','zipcode' => '630'),
            array('id' => '176','city' => '雲林縣','area' => '大埤鄉','zipcode' => '631'),
            array('id' => '177','city' => '雲林縣','area' => '虎尾鎮','zipcode' => '632'),
            array('id' => '178','city' => '雲林縣','area' => '土庫鎮','zipcode' => '633'),
            array('id' => '179','city' => '雲林縣','area' => '褒忠鄉','zipcode' => '634'),
            array('id' => '180','city' => '雲林縣','area' => '東勢鄉','zipcode' => '635'),
            array('id' => '181','city' => '雲林縣','area' => '臺西鄉','zipcode' => '636'),
            array('id' => '182','city' => '雲林縣','area' => '崙背鄉','zipcode' => '637'),
            array('id' => '183','city' => '雲林縣','area' => '麥寮鄉','zipcode' => '638'),
            array('id' => '184','city' => '雲林縣','area' => '斗六市','zipcode' => '640'),
            array('id' => '185','city' => '雲林縣','area' => '林內鄉','zipcode' => '643'),
            array('id' => '186','city' => '雲林縣','area' => '古坑鄉','zipcode' => '646'),
            array('id' => '187','city' => '雲林縣','area' => '莿桐鄉','zipcode' => '647'),
            array('id' => '188','city' => '雲林縣','area' => '西螺鎮','zipcode' => '648'),
            array('id' => '189','city' => '雲林縣','area' => '二崙鄉','zipcode' => '649'),
            array('id' => '190','city' => '雲林縣','area' => '北港鎮','zipcode' => '651'),
            array('id' => '191','city' => '雲林縣','area' => '水林鄉','zipcode' => '652'),
            array('id' => '192','city' => '雲林縣','area' => '口湖鄉','zipcode' => '653'),
            array('id' => '193','city' => '雲林縣','area' => '四湖鄉','zipcode' => '654'),
            array('id' => '194','city' => '雲林縣','area' => '元長鄉','zipcode' => '655'),
            array('id' => '195','city' => '嘉義市','area' => '東區','zipcode' => '600'),
            array('id' => '196','city' => '嘉義縣','area' => '番路鄉','zipcode' => '602'),
            array('id' => '197','city' => '嘉義縣','area' => '梅山鄉','zipcode' => '603'),
            array('id' => '198','city' => '嘉義縣','area' => '竹崎鄉','zipcode' => '604'),
            array('id' => '199','city' => '嘉義縣','area' => '阿里山鄉','zipcode' => '605'),
            array('id' => '200','city' => '嘉義縣','area' => '中埔鄉','zipcode' => '606'),
            array('id' => '201','city' => '嘉義縣','area' => '大埔鄉','zipcode' => '607'),
            array('id' => '202','city' => '嘉義縣','area' => '水上鄉','zipcode' => '608'),
            array('id' => '203','city' => '嘉義縣','area' => '鹿草鄉','zipcode' => '611'),
            array('id' => '204','city' => '嘉義縣','area' => '太保市','zipcode' => '612'),
            array('id' => '205','city' => '嘉義縣','area' => '朴子市','zipcode' => '613'),
            array('id' => '206','city' => '嘉義縣','area' => '東石鄉','zipcode' => '614'),
            array('id' => '207','city' => '嘉義縣','area' => '六腳鄉','zipcode' => '615'),
            array('id' => '208','city' => '嘉義縣','area' => '新港鄉','zipcode' => '616'),
            array('id' => '209','city' => '嘉義縣','area' => '民雄鄉','zipcode' => '621'),
            array('id' => '210','city' => '嘉義縣','area' => '大林鎮','zipcode' => '622'),
            array('id' => '211','city' => '嘉義縣','area' => '溪口鄉','zipcode' => '623'),
            array('id' => '212','city' => '嘉義縣','area' => '義竹鄉','zipcode' => '624'),
            array('id' => '213','city' => '嘉義縣','area' => '布袋鎮','zipcode' => '625'),
            array('id' => '214','city' => '台南市','area' => '中西區','zipcode' => '700'),
            array('id' => '215','city' => '台南市','area' => '東區','zipcode' => '701'),
            array('id' => '216','city' => '台南市','area' => '南區','zipcode' => '702'),
            array('id' => '217','city' => '台南市','area' => '北區','zipcode' => '704'),
            array('id' => '218','city' => '台南市','area' => '安平區','zipcode' => '708'),
            array('id' => '219','city' => '台南市','area' => '安南區','zipcode' => '709'),
            array('id' => '220','city' => '台南市','area' => '永康區','zipcode' => '710'),
            array('id' => '221','city' => '台南市','area' => '歸仁區','zipcode' => '711'),
            array('id' => '222','city' => '台南市','area' => '新化區','zipcode' => '712'),
            array('id' => '223','city' => '台南市','area' => '左鎮區','zipcode' => '713'),
            array('id' => '224','city' => '台南市','area' => '玉井區','zipcode' => '714'),
            array('id' => '225','city' => '台南市','area' => '楠西區','zipcode' => '715'),
            array('id' => '226','city' => '台南市','area' => '南化區','zipcode' => '716'),
            array('id' => '227','city' => '台南市','area' => '仁德區','zipcode' => '717'),
            array('id' => '228','city' => '台南市','area' => '關廟區','zipcode' => '718'),
            array('id' => '229','city' => '台南市','area' => '龍崎區','zipcode' => '719'),
            array('id' => '230','city' => '台南市','area' => '官田區','zipcode' => '720'),
            array('id' => '231','city' => '台南市','area' => '麻豆區','zipcode' => '721'),
            array('id' => '232','city' => '台南市','area' => '佳里區','zipcode' => '722'),
            array('id' => '233','city' => '台南市','area' => '西港區','zipcode' => '723'),
            array('id' => '234','city' => '台南市','area' => '七股區','zipcode' => '724'),
            array('id' => '235','city' => '台南市','area' => '將軍區','zipcode' => '725'),
            array('id' => '236','city' => '台南市','area' => '學甲區','zipcode' => '726'),
            array('id' => '237','city' => '台南市','area' => '北門區','zipcode' => '727'),
            array('id' => '238','city' => '台南市','area' => '新營區','zipcode' => '730'),
            array('id' => '239','city' => '台南市','area' => '後壁區','zipcode' => '731'),
            array('id' => '240','city' => '台南市','area' => '白河區','zipcode' => '732'),
            array('id' => '241','city' => '台南市','area' => '東山區','zipcode' => '733'),
            array('id' => '242','city' => '台南市','area' => '六甲區','zipcode' => '734'),
            array('id' => '243','city' => '台南市','area' => '下營區','zipcode' => '735'),
            array('id' => '244','city' => '台南市','area' => '柳營區','zipcode' => '736'),
            array('id' => '245','city' => '台南市','area' => '鹽水區','zipcode' => '737'),
            array('id' => '246','city' => '台南市','area' => '善化區','zipcode' => '741'),
            array('id' => '247','city' => '台南市','area' => '大內區','zipcode' => '742'),
            array('id' => '248','city' => '台南市','area' => '山上區','zipcode' => '743'),
            array('id' => '249','city' => '台南市','area' => '新市區','zipcode' => '744'),
            array('id' => '250','city' => '台南市','area' => '安定區','zipcode' => '745'),
            array('id' => '251','city' => '高雄市','area' => '新興區','zipcode' => '800'),
            array('id' => '252','city' => '高雄市','area' => '前金區','zipcode' => '801'),
            array('id' => '253','city' => '高雄市','area' => '苓雅區','zipcode' => '802'),
            array('id' => '254','city' => '高雄市','area' => '鹽埕區','zipcode' => '803'),
            array('id' => '255','city' => '高雄市','area' => '鼓山區','zipcode' => '804'),
            array('id' => '256','city' => '高雄市','area' => '旗津區','zipcode' => '805'),
            array('id' => '257','city' => '高雄市','area' => '前鎮區','zipcode' => '806'),
            array('id' => '258','city' => '高雄市','area' => '三民區','zipcode' => '807'),
            array('id' => '259','city' => '高雄市','area' => '楠梓區','zipcode' => '811'),
            array('id' => '260','city' => '高雄市','area' => '小港區','zipcode' => '812'),
            array('id' => '261','city' => '高雄市','area' => '左營區','zipcode' => '813'),
            array('id' => '262','city' => '高雄市','area' => '仁武區','zipcode' => '814'),
            array('id' => '263','city' => '高雄市','area' => '大社區','zipcode' => '815'),
            array('id' => '264','city' => '高雄市','area' => '岡山區','zipcode' => '820'),
            array('id' => '265','city' => '高雄市','area' => '路竹區','zipcode' => '821'),
            array('id' => '266','city' => '高雄市','area' => '阿蓮區','zipcode' => '822'),
            array('id' => '267','city' => '高雄市','area' => '田寮區','zipcode' => '823'),
            array('id' => '268','city' => '高雄市','area' => '燕巢區','zipcode' => '824'),
            array('id' => '269','city' => '高雄市','area' => '橋頭區','zipcode' => '825'),
            array('id' => '270','city' => '高雄市','area' => '梓官區','zipcode' => '826'),
            array('id' => '271','city' => '高雄市','area' => '彌陀區','zipcode' => '827'),
            array('id' => '272','city' => '高雄市','area' => '永安區','zipcode' => '828'),
            array('id' => '273','city' => '高雄市','area' => '湖內區','zipcode' => '829'),
            array('id' => '274','city' => '高雄市','area' => '鳳山區','zipcode' => '830'),
            array('id' => '275','city' => '高雄市','area' => '大寮區','zipcode' => '831'),
            array('id' => '276','city' => '高雄市','area' => '林園區','zipcode' => '832'),
            array('id' => '277','city' => '高雄市','area' => '鳥松區','zipcode' => '833'),
            array('id' => '278','city' => '高雄市','area' => '大樹區','zipcode' => '840'),
            array('id' => '279','city' => '高雄市','area' => '旗山區','zipcode' => '842'),
            array('id' => '280','city' => '高雄市','area' => '美濃區','zipcode' => '843'),
            array('id' => '281','city' => '高雄市','area' => '六龜區','zipcode' => '844'),
            array('id' => '282','city' => '高雄市','area' => '內門區','zipcode' => '845'),
            array('id' => '283','city' => '高雄市','area' => '杉林區','zipcode' => '846'),
            array('id' => '284','city' => '高雄市','area' => '甲仙區','zipcode' => '847'),
            array('id' => '285','city' => '高雄市','area' => '桃源區','zipcode' => '848'),
            array('id' => '286','city' => '高雄市','area' => '那瑪夏區','zipcode' => '849'),
            array('id' => '287','city' => '高雄市','area' => '茂林區','zipcode' => '851'),
            array('id' => '288','city' => '高雄市','area' => '茄萣區','zipcode' => '852'),
            array('id' => '369','city' => '新竹市','area' => '東區','zipcode' => '300'),
            array('id' => '291','city' => '澎湖縣','area' => '馬公市','zipcode' => '880'),
            array('id' => '292','city' => '澎湖縣','area' => '西嶼鄉','zipcode' => '881'),
            array('id' => '293','city' => '澎湖縣','area' => '望安鄉','zipcode' => '882'),
            array('id' => '294','city' => '澎湖縣','area' => '七美鄉','zipcode' => '883'),
            array('id' => '295','city' => '澎湖縣','area' => '白沙鄉','zipcode' => '884'),
            array('id' => '296','city' => '澎湖縣','area' => '湖西鄉','zipcode' => '885'),
            array('id' => '297','city' => '屏東縣','area' => '屏東市','zipcode' => '900'),
            array('id' => '298','city' => '屏東縣','area' => '三地門鄉','zipcode' => '901'),
            array('id' => '299','city' => '屏東縣','area' => '霧臺鄉','zipcode' => '902'),
            array('id' => '300','city' => '屏東縣','area' => '瑪家鄉','zipcode' => '903'),
            array('id' => '301','city' => '屏東縣','area' => '九如鄉','zipcode' => '904'),
            array('id' => '302','city' => '屏東縣','area' => '里港鄉','zipcode' => '905'),
            array('id' => '303','city' => '屏東縣','area' => '高樹鄉','zipcode' => '906'),
            array('id' => '304','city' => '屏東縣','area' => '鹽埔鄉','zipcode' => '907'),
            array('id' => '305','city' => '屏東縣','area' => '長治鄉','zipcode' => '908'),
            array('id' => '306','city' => '屏東縣','area' => '麟洛鄉','zipcode' => '909'),
            array('id' => '307','city' => '屏東縣','area' => '竹田鄉','zipcode' => '911'),
            array('id' => '308','city' => '屏東縣','area' => '內埔鄉','zipcode' => '912'),
            array('id' => '309','city' => '屏東縣','area' => '萬丹鄉','zipcode' => '913'),
            array('id' => '310','city' => '屏東縣','area' => '潮州鎮','zipcode' => '920'),
            array('id' => '311','city' => '屏東縣','area' => '泰武鄉','zipcode' => '921'),
            array('id' => '312','city' => '屏東縣','area' => '來義鄉','zipcode' => '922'),
            array('id' => '313','city' => '屏東縣','area' => '萬巒鄉','zipcode' => '923'),
            array('id' => '314','city' => '屏東縣','area' => '崁頂鄉','zipcode' => '924'),
            array('id' => '315','city' => '屏東縣','area' => '新埤鄉','zipcode' => '925'),
            array('id' => '316','city' => '屏東縣','area' => '南州鄉','zipcode' => '926'),
            array('id' => '317','city' => '屏東縣','area' => '林邊鄉','zipcode' => '927'),
            array('id' => '318','city' => '屏東縣','area' => '東港鄉','zipcode' => '928'),
            array('id' => '319','city' => '屏東縣','area' => '琉球鄉','zipcode' => '929'),
            array('id' => '320','city' => '屏東縣','area' => '佳冬鄉','zipcode' => '931'),
            array('id' => '321','city' => '屏東縣','area' => '新園鄉','zipcode' => '932'),
            array('id' => '322','city' => '屏東縣','area' => '枋寮鄉','zipcode' => '940'),
            array('id' => '323','city' => '屏東縣','area' => '枋山鄉','zipcode' => '941'),
            array('id' => '324','city' => '屏東縣','area' => '春日鄉','zipcode' => '942'),
            array('id' => '325','city' => '屏東縣','area' => '獅子鄉','zipcode' => '943'),
            array('id' => '326','city' => '屏東縣','area' => '車城鄉','zipcode' => '944'),
            array('id' => '327','city' => '屏東縣','area' => '牡丹鄉','zipcode' => '945'),
            array('id' => '328','city' => '屏東縣','area' => '恆春鄉','zipcode' => '946'),
            array('id' => '329','city' => '屏東縣','area' => '滿州鄉','zipcode' => '947'),
            array('id' => '330','city' => '台東縣','area' => '臺東市','zipcode' => '950'),
            array('id' => '331','city' => '台東縣','area' => '綠島鄉','zipcode' => '951'),
            array('id' => '332','city' => '台東縣','area' => '蘭嶼鄉','zipcode' => '952'),
            array('id' => '333','city' => '台東縣','area' => '延平鄉','zipcode' => '953'),
            array('id' => '334','city' => '台東縣','area' => '卑南鄉','zipcode' => '954'),
            array('id' => '335','city' => '台東縣','area' => '鹿野鄉','zipcode' => '955'),
            array('id' => '336','city' => '台東縣','area' => '關山鎮','zipcode' => '956'),
            array('id' => '337','city' => '台東縣','area' => '海端鄉','zipcode' => '957'),
            array('id' => '338','city' => '台東縣','area' => '池上鄉','zipcode' => '958'),
            array('id' => '339','city' => '台東縣','area' => '東河鄉','zipcode' => '959'),
            array('id' => '340','city' => '台東縣','area' => '成功鎮','zipcode' => '961'),
            array('id' => '341','city' => '台東縣','area' => '長濱鄉','zipcode' => '962'),
            array('id' => '342','city' => '台東縣','area' => '太麻里鄉','zipcode' => '963'),
            array('id' => '343','city' => '台東縣','area' => '金峰鄉','zipcode' => '964'),
            array('id' => '344','city' => '台東縣','area' => '大武鄉','zipcode' => '965'),
            array('id' => '345','city' => '台東縣','area' => '達仁鄉','zipcode' => '966'),
            array('id' => '346','city' => '花蓮縣','area' => '花蓮市','zipcode' => '970'),
            array('id' => '347','city' => '花蓮縣','area' => '新城鄉','zipcode' => '971'),
            array('id' => '348','city' => '花蓮縣','area' => '秀林鄉','zipcode' => '972'),
            array('id' => '349','city' => '花蓮縣','area' => '吉安鄉','zipcode' => '973'),
            array('id' => '350','city' => '花蓮縣','area' => '壽豐鄉','zipcode' => '974'),
            array('id' => '351','city' => '花蓮縣','area' => '鳳林鎮','zipcode' => '975'),
            array('id' => '352','city' => '花蓮縣','area' => '光復鄉','zipcode' => '976'),
            array('id' => '353','city' => '花蓮縣','area' => '豐濱鄉','zipcode' => '977'),
            array('id' => '354','city' => '花蓮縣','area' => '瑞穗鄉','zipcode' => '978'),
            array('id' => '355','city' => '花蓮縣','area' => '萬榮鄉','zipcode' => '979'),
            array('id' => '356','city' => '花蓮縣','area' => '玉里鎮','zipcode' => '981'),
            array('id' => '357','city' => '花蓮縣','area' => '卓溪鄉','zipcode' => '982'),
            array('id' => '358','city' => '花蓮縣','area' => '富里鄉','zipcode' => '983'),
            array('id' => '359','city' => '金門縣','area' => '金沙鎮','zipcode' => '890'),
            array('id' => '360','city' => '金門縣','area' => '金湖鎮','zipcode' => '891'),
            array('id' => '361','city' => '金門縣','area' => '金寧鄉','zipcode' => '892'),
            array('id' => '362','city' => '金門縣','area' => '金城鎮','zipcode' => '893'),
            array('id' => '363','city' => '金門縣','area' => '烈嶼鄉','zipcode' => '894'),
            array('id' => '364','city' => '金門縣','area' => '烏坵鄉','zipcode' => '896'),
            array('id' => '365','city' => '連江縣','area' => '南竿鄉','zipcode' => '209'),
            array('id' => '366','city' => '連江縣','area' => '北竿鄉','zipcode' => '210'),
            array('id' => '367','city' => '連江縣','area' => '莒光鄉','zipcode' => '211'),
            array('id' => '368','city' => '連江縣','area' => '東引鄉','zipcode' => '212'),
            array('id' => '370','city' => '新竹市','area' => '香山區','zipcode' => '300'),
            array('id' => '371','city' => '嘉義市','area' => '西區','zipcode' => '600')
          );


            foreach($lm_area as $area_key => $area_val){
                Areas::factory()->create([
                    'city' => $area_val['city'],
                    'area' => $area_val['area'],
                    'zipcode' => $area_val['zipcode'],
                ]);
            }
        //縣市區域 END

        //系統資訊設定 START
            SysSettings::factory()->create([
                'sys_name'                  => 'ChoChoco',
                'sys_logo'                  => '',
                'sys_start_date'            => '',
                'sys_end_date'              => '',
                'sys_deny_ip'               => '',

                'sys_api_id'                => '2000132',
                'sys_api_hashkey'           => '5294y06JbISpM5x9',
                'sys_api_hashiv'            => 'v77hoKGq4kWxNNIS',

                'sys_api_ctc_id'            => '2000933',
                'sys_api_ctc_hashkey'       => 'XBERn1YOvpM9nfZc',
                'sys_api_ctc_hashiv'        => 'h1ONHk4P4yqbl5LK',
            ]);
        //系統資訊設定 END

        //系統模組 START
            $modules = [
                'sys_settings' => [
                    'module_display_name'       => '系統資訊',
                    'module_model_name'         => 'App\Models\SysSettings',
                    'module_controller_name'    => 'App\Http\Controllers\SysSettingController',
                    'category_id'               => 1,
                ],
                'modules' => [
                    'module_display_name'       => '系統模組',
                    'module_model_name'         => 'App\Models\Modules',
                    'module_controller_name'    => 'App\Http\Controllers\ModuleController',
                    'category_id'               => 1,
                ],
                'module_categorys' => [
                    'module_display_name'       => '模組分類',
                    'module_model_name'         => 'App\Models\ModuleCategorys',
                    'module_controller_name'    => 'App\Http\Controllers\ModuleCategoryController',
                    'category_id'               => 1,
                ],
                'accounts' => [
                    'module_display_name'       => '系統帳號',
                    'module_model_name'         => 'App\Models\Accounts',
                    'module_controller_name'    => 'App\Http\Controllers\AccountController',
                    'category_id'               => 1,
                ],
                'roles' => [
                    'module_display_name'       => '系統權限',
                    'module_model_name'         => 'App\Models\Roles',
                    'module_controller_name'    => 'App\Http\Controllers\RoleController',
                    'category_id'               => 1,
                ],
                'sitemap_frames' => [
                    'module_display_name'       => '網站架構',
                    'module_model_name'         => 'App\Models\SitemapFrames',
                    'module_controller_name'    => 'App\Http\Controllers\SitemapFramesController',
                    'category_id'               => 2,
                ],
                'layouts' => [
                    'module_display_name'       => '畫面佈局',
                    'module_model_name'         => 'App\Models\Layouts',
                    'module_controller_name'    => 'App\Http\Controllers\LayoutController',
                    'category_id'               => 2,
                ],
                'articles' => [
                    'module_display_name'       => '文章管理',
                    'module_model_name'         => 'App\Models\Articles',
                    'module_controller_name'    => 'App\Http\Controllers\ArticleController',
                    'category_id'               => 2,
                ],
                'products' => [
                    'module_display_name'       => '商品管理',
                    'module_model_name'         => 'App\Models\Products',
                    'module_controller_name'    => 'App\Http\Controllers\ProductController',
                    'category_id'               => 3,
                ],
                'members' => [
                    'module_display_name'       => '會員管理',
                    'module_model_name'         => 'App\Models\Members',
                    'module_controller_name'    => 'App\Http\Controllers\MemberController',
                    'category_id'               => 3,
                ],
                'orders' => [
                    'module_display_name'       => '訂單管理',
                    'module_model_name'         => 'App\Models\Orders',
                    'module_controller_name'    => 'App\Http\Controllers\OrderController',
                    'category_id'               => 3,
                ],
            ];

            foreach($modules as $key2 => $val2){
                Modules::factory()->create([
                    'module_name'               => $key2,
                    'module_display_name'       => $val2['module_display_name'],
                    'module_model_name'         => $val2['module_model_name'],
                    'module_controller_name'    => $val2['module_controller_name'],
                    'category_id'               => $val2['category_id'],
                ]);
            }
        //系統模組 END

        //模組分類 START
        
            $module_category = [
                '系統功能',
                '頁面設定',
                '資料維護'
            ];

            foreach($module_category as $category_name){
                ModuleCategorys::create([
                    'category_name' => $category_name
                ]);
            }
        

        //模組分類 END

        //系統帳號 START
            // Accounts::factory(15)->create();

            Accounts::create([
                'account_role'      => '1',
                'account_name'      => 'test_admin',
                'account_password'  => 'test1234',
                'account_realname'  => '測試帳號(系統管理者)',
                'account_email'     => 'test1@mail.com',
                'account_phone'     => '',
                'account_cellphone' => '',
                'account_photo'     => '',
                'account_disabled'  => 0
            ]);

            Accounts::create([
                'account_role'      => '2',
                'account_name'      => 'test_user',
                'account_password'  => 'test1234',
                'account_realname'  => '測試帳號(一般使用者)',
                'account_email'     => 'test2@mail.com',
                'account_phone'     => '',
                'account_cellphone' => '',
                'account_photo'     => '',
                'account_disabled'  => 0
            ]);
        //系統帳號 END

        //系統角色 START
            $roles = [
                '系統管理者',
                '一般使用者',
            ];

            foreach($roles as $val){
                Roles::factory()->create([
                    'role_name' => $val
                ]);
            }
        //系統角色 END

        //系統全權限 START
            $permissions = [
                'sys_settings_list'             => '列表',
                'sys_settings_create'           => '新增',
                'sys_settings_update'           => '更新',
                'sys_settings_delete'           => '刪除',

                'modules_list'                  => '列表',
                'modules_create'                => '新增',
                'modules_update'                => '更新',
                'modules_delete'                => '刪除',

                'module_categorys_list'         => '列表',
                'module_categorys_create'       => '新增',
                'module_categorys_update'       => '更新',
                'module_categorys_delete'       => '刪除',

                'accounts_list'                 => '列表',
                'accounts_create'               => '新增',
                'accounts_update'               => '更新',
                'accounts_delete'               => '刪除',

                'roles_list'                    => '列表',
                'roles_create'                  => '新增',
                'roles_update'                  => '更新',
                'roles_delete'                  => '刪除',

                'sitemap_frames_list'           => '列表',
                'sitemap_frames_create'         => '新增',
                'sitemap_frames_update'         => '更新',
                'sitemap_frames_delete'         => '刪除',

                'layouts_list'                  => '列表',
                'layouts_create'                => '新增',
                'layouts_update'                => '更新',
                'layouts_delete'                => '刪除',

                'articles_list'                 => '列表',
                'articles_create'               => '新增',
                'articles_update'               => '更新',
                'articles_delete'               => '刪除',

                'products_list'                 => '列表',
                'products_create'               => '新增',
                'products_update'               => '更新',
                'products_delete'               => '刪除',

                'members_list'                  => '列表',
                'members_create'                => '新增',
                'members_update'                => '更新',
                'members_delete'                => '刪除',

                'orders_list'                   => '列表',
                'orders_create'                 => '新增',
                'orders_update'                 => '更新',
                'orders_delete'                 => '刪除',
            ];

            $count = 0;
            $module_id = 0;
            foreach($permissions as $k => $v){

                if($count % 4 == 0){
                    $module_id++;
                }

                Permissions::create([
                    'permission_name' => $k,
                    'permission_display_name' => $v,
                    'module_id' => $module_id,
                ]);

                $count++;
            }
        //系統全權限 END

        //角色與權限關聯 START
            $permission_role = [
                '1' => '1',
                '2' => '1',
                '3' => '1',
                '4' => '1',
                '5' => '1',
                '6' => '1',
                '7' => '1',
                '8' => '1',
                '9' => '1',
                '10' => '1',
                '11' => '1',
                '12' => '1',
                '13' => '1',
                '14' => '1',
                '15' => '1',
                '16' => '1',
                '17' => '1',
                '18' => '1',
                '19' => '1',
                '20' => '1',
                '21' => '1',
                '22' => '1',
                '23' => '1',
                '24' => '1',
                '25' => '1',
                '26' => '1',
                '27' => '1',
                '28' => '1',
                '29' => '1',
                '30' => '1',
                '31' => '1',
                '32' => '1',
                '33' => '1',
                '34' => '1',
                '35' => '1',
                '36' => '1',
                '37' => '1',
                '38' => '1',
                '39' => '1',
                '40' => '1',
                '41' => '1',
                '42' => '1',
                '43' => '1',
                '44' => '1',
            ];

            foreach($permission_role as $key1 => $val1){
                PermissionRoles::factory()->create([
                    'permission_id' => $key1,
                    'role_id' => $val1
                ]);
            }
        //角色與權限關聯 END

        //網站架構 START

            $sitemap_frames = [
                '0' => [
                    'frame_display_name'    => '首頁',
                    'frame_name'            => 'index',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '1',
                    'type_content_layout_id'=> '1',
                    'type_list_layout_id'   => '0',
                    'use_module_model'      => '0',
                    'module_id'             => '0',
                    'is_index'              => '1',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '0',
                ],
                '1' => [
                    'frame_display_name'    => '經典商品',
                    'frame_name'            => 'products',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '4',
                    'type_content_layout_id'=> '0',
                    'type_list_layout_id'   => '0',
                    'use_module_model'      => '0',
                    'module_id'             => '0',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '0',
                ],
                '2' => [
                    'frame_display_name'    => '關於我們',
                    'frame_name'            => 'about-us',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '1',
                    'type_content_layout_id'=> '5',
                    'type_list_layout_id'   => '0',
                    'use_module_model'      => '0',
                    'module_id'             => '0',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '0',
                ],
                '3' => [
                    'frame_display_name'    => '信仰價值',
                    'frame_name'            => 'our-quality',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '2',
                    'type_content_layout_id'=> '0',
                    'type_list_layout_id'   => '6',
                    'use_module_model'      => '0',
                    'module_id'             => '0',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '0',
                ],
                '4' => [
                    'frame_display_name'    => '會員中心',
                    'frame_name'            => 'member-center',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '1',
                    'type_content_layout_id'=> '9',
                    'type_list_layout_id'   => '0',
                    'use_module_model'      => '1',
                    'module_id'             => '10',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '0',
                ],
                '5' => [
                    'frame_display_name'    => '經典巧克力',
                    'frame_name'            => 'chocolate',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '3',
                    'type_content_layout_id'=> '4',
                    'type_list_layout_id'   => '2',
                    'use_module_model'      => '1',
                    'module_id'             => '9',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '2',
                ],
                '6' => [
                    'frame_display_name'    => '經典蛋糕',
                    'frame_name'            => 'cake',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '3',
                    'type_content_layout_id'=> '4',
                    'type_list_layout_id'   => '3',
                    'use_module_model'      => '1',
                    'module_id'             => '9',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '2',
                ],
                '7' => [
                    'frame_display_name'    => '彌月蛋糕',
                    'frame_name'            => 'miyuki-cake',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '3',
                    'type_content_layout_id'=> '4',
                    'type_list_layout_id'   => '3',
                    'use_module_model'      => '1',
                    'module_id'             => '9',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '2',
                ],
                '8' => [
                    'frame_display_name'    => '商品結帳',
                    'frame_name'            => 'check-out',
                    'is_external_link'      => '0',
                    'link_url'              => '',
                    'frame_type'            => '1',
                    'type_content_layout_id'=> '10',
                    'type_list_layout_id'   => '0',
                    'use_module_model'      => '1',
                    'module_id'             => '11',
                    'is_index'              => '0',
                    'is_disabled'           => '0',
                    'parent_frame_id'       => '0',
                ],
                
            ];

            foreach($sitemap_frames as $sitemap_frame_key => $sitemap_frame_val){
                
                SitemapFrames::factory()->create([
                    'frame_display_name'        => $sitemap_frame_val['frame_display_name'],
                    'frame_name'                => $sitemap_frame_val['frame_name'],
                    'is_external_link'          => $sitemap_frame_val['is_external_link'],
                    'link_url'                  => $sitemap_frame_val['link_url'],
                    'frame_type'                => $sitemap_frame_val['frame_type'],
                    'type_content_layout_id'    => $sitemap_frame_val['type_content_layout_id'],
                    'type_list_layout_id'       => $sitemap_frame_val['type_list_layout_id'],
                    'use_module_model'          => $sitemap_frame_val['use_module_model'],
                    'module_id'                 => $sitemap_frame_val['module_id'],
                    'is_index'                  => $sitemap_frame_val['is_index'],
                    'is_disabled'               => $sitemap_frame_val['is_disabled'],
                    'parent_frame_id'           => $sitemap_frame_val['parent_frame_id'],
                ]);
            }
        
        //網站架構 END

        //畫面佈局 START
        
            $layouts = [
                '0' => [
                    'layout_name'       => '首頁佈局',
                    'layout_root'       => 'index',
                    'layout_view_root'  => 'frontend.layouts.index'
                ],
                '1' => [
                    'layout_name'       => '巧克力列表頁佈局',
                    'layout_root'       => 'chocolate_list',
                    'layout_view_root'  => 'frontend.layouts.chocolate_list'
                ],
                '2' => [
                    'layout_name'       => '蛋糕列表頁佈局',
                    'layout_root'       => 'cake_list',
                    'layout_view_root'  => 'frontend.layouts.cake_list'
                ],
                '3' => [
                    'layout_name'       => '產品內容頁佈局',
                    'layout_root'       => 'product_detail',
                    'layout_view_root'  => 'frontend.layouts.product_detail'
                ],
                '4' => [
                    'layout_name'       => '關於我們',
                    'layout_root'       => 'about_us',
                    'layout_view_root'  => 'frontend.layouts.about_us'
                ],
                '5' => [
                    'layout_name'       => '信仰價值',
                    'layout_root'       => 'our_quality',
                    'layout_view_root'  => 'frontend.layouts.our_quality'
                ],
                '6' => [
                    'layout_name'       => '前台登入頁',
                    'layout_root'       => 'login_page',
                    'layout_view_root'  => 'frontend.layouts.login_page'
                ],
                '7' => [
                    'layout_name'       => '前台註冊頁',
                    'layout_root'       => 'signin_page',
                    'layout_view_root'  => 'frontend.layouts.signin_page'
                ],
                '8' => [
                    'layout_name'       => '會員中心_會員資料',
                    'layout_root'       => 'member_center',
                    'layout_view_root'  => 'frontend.layouts.member_center'
                ],
                '9' => [
                    'layout_name'       => '商品結帳',
                    'layout_root'       => 'check_out',
                    'layout_view_root'  => 'frontend.layouts.check_out'
                ],
            ];

            foreach($layouts as $layout_key => $layout_val){
                Layouts::factory()->create([
                    'layout_name' => $layout_val['layout_name'],
                    'layout_root' => $layout_val['layout_root'],
                    'layout_view_root' => $layout_val['layout_view_root'],
                ]);
            }

        //畫面佈局 END

        //架構變數設定 START

            $frame_fields_setting = [
                '0' => [
                    'frame_id'              => '3',
                    'field_display_name'    => '文章內容',
                    'field_name'            => 'about_us_content',
                    'field_type'            => '5',
                    'field_option'          => '',
                ],
                '1' => [
                    'frame_id'              => '3',
                    'field_display_name'    => '圖片上傳',
                    'field_name'            => 'about_us_img',
                    'field_type'            => '6',
                    'field_option'          => '',
                ],
                '2' => [
                    'frame_id'              => '4',
                    'field_display_name'    => '標題',
                    'field_name'            => 'our_quality_title',
                    'field_type'            => '1',
                    'field_option'          => '',
                ],
                '3' => [
                    'frame_id'              => '4',
                    'field_display_name'    => '內容',
                    'field_name'            => 'our_quality_content',
                    'field_type'            => '5',
                    'field_option'          => '',
                ],
                '4' => [
                    'frame_id'              => '4',
                    'field_display_name'    => '圖片上傳',
                    'field_name'            => 'our_quality_img',
                    'field_type'            => '6',
                    'field_option'          => '',
                ],
            ];

            foreach($frame_fields_setting as $frame_fields_setting_key => $frame_fields_setting_val){
                FrameFieldsSetting::factory()->create([
                    'frame_id'              => $frame_fields_setting_val['frame_id'],
                    'field_display_name'    => $frame_fields_setting_val['field_display_name'],
                    'field_name'            => $frame_fields_setting_val['field_name'],
                    'field_type'            => $frame_fields_setting_val['field_type'],
                    'field_option'          => $frame_fields_setting_val['field_option'],
                ]);
            }
        //架構變數設定 END

        //文章管理 START

            $article = [
                '0' => [
                    'frame_id'      => '3',
                    'data_title'    => '關於我們',
                    'is_show'       => '1',
                ],
                '1' => [
                    'frame_id'      => '4',
                    'data_title'    => '奶油',
                    'is_show'       => '1',
                ],
                '2' => [
                    'frame_id'      => '4',
                    'data_title'    => '果泥',
                    'is_show'       => '1',
                ],
                '3' => [
                    'frame_id'      => '4',
                    'data_title'    => '鹽之花',
                    'is_show'       => '1',
                ],
                '4' => [
                    'frame_id'      => '4',
                    'data_title'    => '麵粉',
                    'is_show'       => '1',
                ],
            ];

            foreach($article as $article_key => $article_val){
                Articles::factory()->create([
                    'frame_id'      => $article_val['frame_id'],
                    'data_title'    => $article_val['data_title'],
                    'is_show'       => $article_val['is_show'],
                ]);
            }

        //文章管理 END

        //文章欄位值設定 START

            $frame_fields_value = [
                '0' => [
                    'article_id'    => '1',
                    'setting_id'    => '1',
                    'field_value'   => '巧克力是催情的種子，但是經過長途的旅行，花了不少錢買回家躺在冰箱的巧克力，入口後卻常常是夢幻破滅的開始，變形或者外表一層白霜，在口中失去熱情與風味，為何在旅途時試吃時那種入口即化，可可香氣與口舌之間產生的旖旎變化，那種比咖啡還香，比紅茶還濃郁，比蛋糕甜點還要美進心坎的情意，消失殆盡。於是Chochoco努力的尋找答案，原來巧克力是嬌嫩無比的小女孩，必須小心呵護，維持在16-20度才是最佳品味溫度，更重要的是巧克力的最佳賞味期只有一~二周，難怪從國外千里迢迢回來的巧克力再貴也吃不到風味絕佳的臻品。最頂級的可可搭配最頂級的食材，儲存在最佳溫度，成就了今天的chochoco，那種從固體觸到口中溫度立時轉為液體，並且迸出濃郁可可香氣的流動感，竄進了每個人的靈魂與心靈。',
                ],
                '1' => [
                    'article_id'    => '1',
                    'setting_id'    => '2',
                    'field_value'   => 'article_file/about_us.jpg',
                ],
                //-----------------------------------------------------------------------------
                '2' => [
                    'article_id'    => '2',
                    'setting_id'    => '3',
                    'field_value'   => '奶油',
                ],
                '3' => [
                    'article_id'    => '2',
                    'setting_id'    => '4',
                    'field_value'   => '牛奶提煉後做成的油脂稱之為奶油，經過冷卻發酵成形後液體的牛奶就會變成固體的奶油，乳白變金黃色的這個路程被稱為奶製品的煉金術。22公斤的牛奶才能提煉出一公斤的奶油，不同國家不同產區奶油乳脂的含量不同；法國屬於頂級優質產區，諾曼地的奶油乳脂高而且香醇更是法國之最！目前台灣販售知名的Elle&Vire President Isigny都是法國頂級餐廳及烘焙甜點店也都做用這些品牌為主，其中Elle&Vire更是在盲測中多年獲得國家金牌獎 Isigny則是法定產區認定AOC的產品。',
                ],
                '4' => [
                    'article_id'    => '2',
                    'setting_id'    => '5',
                    'field_value'   => 'article_file/our-quality-001.jpg',
                ],
                //-----------------------------------------------------------------------------
                '5' => [
                    'article_id'    => '3',
                    'setting_id'    => '3',
                    'field_value'   => '果泥',
                ],
                '6' => [
                    'article_id'    => '3',
                    'setting_id'    => '4',
                    'field_value'   => '嚴選來自法國、世界領導品牌的果泥，水果來源及品種，遵循「產地、品質、色澤」最高要求；以獨特的產品篩選及先進的急速冷凍冷藏技術完成保留了水果原有100％的風味，被譽為「原味重現」的超高科技，強調不添加防腐劑、人工色素、濃稠劑，創造最完美的頂級口味。',
                ],
                '7' => [
                    'article_id'    => '3',
                    'setting_id'    => '5',
                    'field_value'   => 'article_file/our-quality-002.jpg',
                ],
                //-----------------------------------------------------------------------------
                '8' => [
                    'article_id'    => '4',
                    'setting_id'    => '3',
                    'field_value'   => '鹽之花',
                ],
                '9' => [
                    'article_id'    => '4',
                    'setting_id'    => '4',
                    'field_value'   => '被譽為鹽之貴族，因為有淡淡紫羅蘭香氣，有「鹽之紫羅蘭」美稱的「法國鹽之花Fleur de Sel」出生於法國西邊布列塔尼半島，海岬與半島等天然環境，以及艷麗燦爛的陽光，這裡產的海鹽含有的豐富的礦物質，如鎂 、鉀等，並有諸多微量元素，是鹽中之最。幾粒盬之花加在食物上立刻多幾分嫵媚，只有在頂級的餐廳及烘焙才捨得用上，不止因為出身貴氣價格也十分昂貴。盬之花主要產在法國神祕的布列塔尼地區，有名的布列塔尼圓餅就用盬之花來提味，在當地又被稱為新娘之鹽，因為盬田上的鹽十分嬌貴脆弱，長久以來由當地的年輕婦女，細心的呵護採收，辛苦集結的盬賣出去存起來當私房錢，結婚當成嫁妝，雖是小小一粒鹽，卻如鑽石般被呵護。',
                ],
                '10' => [
                    'article_id'    => '4',
                    'setting_id'    => '5',
                    'field_value'   => 'article_file/our-quality-003.jpg',
                ],
                //-----------------------------------------------------------------------------
                '11' => [
                    'article_id'    => '5',
                    'setting_id'    => '3',
                    'field_value'   => '麵粉',
                ],
                '12' => [
                    'article_id'    => '5',
                    'setting_id'    => '4',
                    'field_value'   => '有「麵粉界香奈兒」之稱的日清紫羅蘭麵粉，因為柔細風味被肯定，採用美國西部優質軟白麥，加上稀有的蜜穗白麥(蛋白質較低) ，以加熱的方式切斷小麥的蛋白質，使粉的蛋白筋性降低，台灣一般會以添加小麥澱粉來降低蛋白質的比例。使用時粉的顆粒細緻，蛋白質含量低，操作性及流動性良好。由於不添加小麥澱粉，老化慢，保濕性好、加上耐凍性好，粉顆粒細、口感較輕，化口性極佳 吃起來風味與口感的確就是不一樣。',
                ],
                '13' => [
                    'article_id'    => '5',
                    'setting_id'    => '5',
                    'field_value'   => 'article_file/our-quality-004.jpg',
                ],
            ];

            foreach($frame_fields_value as $frame_fields_value_key => $frame_fields_value_val){
                FrameFieldsValue::factory()->create([
                    'article_id'    => $frame_fields_value_val['article_id'],
                    'setting_id'    => $frame_fields_value_val['setting_id'],
                    'field_value'   => $frame_fields_value_val['field_value'],
                ]);
            }

        //文章欄位值設定 END
        
        //商品管理 START
            
            $products = [
                '0' => [
                    'user_id' => 1,
                    'product_name' => '比利時生巧克力65% -16片',
                    'product_main_category' => 1,
                    'product_category' => '@#1@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/001.jpg',
                    'product_content' => '比利時生巧克力16片裝、緞帶、提袋',
                    'product_description' => '1999年我在比利時的布魯塞爾遇見一種充滿了奇妙滋味的巧克力，在口中彷彿一道黑色暖流融化在舌尖，一直是我無法言說的感官經驗，沒有辦法讓妳跟我一起品嚐這塊巧克力，一直是我心底的遺憾。終於在今年，我在台灣與它重逢，在第一個瞬間，我想到了妳！這是一份經過比利時人精緻熔鍊的心意，在這份心意之中，除了比利時的驕傲之外，還添加了Chochoco對於巧克力的堅持。比利時巧克力的標準作法，是將可可豆研磨至超乎妳想像的20微米，因為更細緻，所以巧克力的質感溫潤如絲絨，適當的甜度，在妳口中可以感受到一種輕柔滑順的幸福。',
                    'product_specification' => '產品成份 - 比利時65%巧克力、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 1,
                ],
                '1' => [
                    'user_id' => 1,
                    'product_name' => '比利時生巧克力65% -25片',
                    'product_main_category' => 1,
                    'product_category' => '@#1@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/002.jpg',
                    'product_content' => '比利時生巧克力16片裝、緞帶、提袋',
                    'product_description' => '1999年我在比利時的布魯塞爾遇見一種充滿了奇妙滋味的巧克力，在口中彷彿一道黑色暖流融化在舌尖，一直是我無法言說的感官經驗，沒有辦法讓妳跟我一起品嚐這塊巧克力，一直是我心底的遺憾。終於在今年，我在台灣與它重逢，在第一個瞬間，我想到了妳！這是一份經過比利時人精緻熔鍊的心意，在這份心意之中，除了比利時的驕傲之外，還添加了Chochoco對於巧克力的堅持。比利時巧克力的標準作法，是將可可豆研磨至超乎妳想像的20微米，因為更細緻，所以巧克力的質感溫潤如絲絨，適當的甜度，在妳口中可以感受到一種輕柔滑順的幸福。',
                    'product_specification' => '產品成份 - 比利時65%巧克力、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '2' => [
                    'user_id' => 1,
                    'product_name' => '比利時生巧克力65% -49片',
                    'product_main_category' => 1,
                    'product_category' => '@#1@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/003.jpg',
                    'product_content' => '比利時生巧克力16片裝、緞帶、提袋',
                    'product_description' => '1999年我在比利時的布魯塞爾遇見一種充滿了奇妙滋味的巧克力，在口中彷彿一道黑色暖流融化在舌尖，一直是我無法言說的感官經驗，沒有辦法讓妳跟我一起品嚐這塊巧克力，一直是我心底的遺憾。終於在今年，我在台灣與它重逢，在第一個瞬間，我想到了妳！這是一份經過比利時人精緻熔鍊的心意，在這份心意之中，除了比利時的驕傲之外，還添加了Chochoco對於巧克力的堅持。比利時巧克力的標準作法，是將可可豆研磨至超乎妳想像的20微米，因為更細緻，所以巧克力的質感溫潤如絲絨，適當的甜度，在妳口中可以感受到一種輕柔滑順的幸福。',
                    'product_specification' => '產品成份 - 比利時65%巧克力、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '3' => [
                    'user_id' => 1,
                    'product_name' => '玫瑰包種生巧克力65% -25片',
                    'product_main_category' => 1,
                    'product_category' => '@#1@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/004.jpg',
                    'product_content' => '玫瑰包種生巧克力25片裝、緞帶、提袋',
                    'product_description' => '巧克力的濃郁搭配玫瑰花茶的芬芳，清雅香氣，繚繞舌尖，令人沉浸於優雅浪漫的氣氛裡，宛如你就在身旁',
                    'product_specification' => '產品成份 - 比利時65%巧克力、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 1,
                ],
                '4' => [
                    'user_id' => 1,
                    'product_name' => '法式典藏生巧克力85%',
                    'product_main_category' => 1,
                    'product_category' => '@#1@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/005.jpg',
                    'product_content' => '法式典藏生巧克力25片裝、緞帶、提袋',
                    'product_description' => '來自象牙海岸奧祕非洲頂級Forasteros可可豆 交錯著像紅酒般的丹寧 非洲產區特有的純淨甘苦風味 堅果的豐富層次特殊的果香發酵酸香 chochoco典藏生巧克力85% 黑巧克力愛好者的最愛！',
                    'product_specification' => '產品成份 - 比利時65%巧克力、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '5' => [
                    'user_id' => 1,
                    'product_name' => '覆盆子生巧克力',
                    'product_main_category' => 1,
                    'product_category' => '@#1@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/006.jpg',
                    'product_content' => '覆盆子生巧克力25片裝、緞帶、提袋',
                    'product_description' => '為了要制止妳任性的想把胭脂敷上巧克力、然後一口吃掉的想望，我趕緊奉上了這一款覆盆子生巧克力，滿足了妳的粉紅色偏執。粉紅色+巧克力這樣的組合，彷彿就是女人基因裡天賦的任性，如此的背反常態、卻又異常地嬌豔可人。酸甜的覆盆子任性的把巧克力當中潛藏的熱帶水果氣息完全勾引出來，讓人無法分清楚剛剛吃下的是水果還是巧克力？覆盆子的餘味又悄悄地和巧克力融為一體，讓巧克力的氣味增添了一種妖豔馥郁的氣息。',
                    'product_specification' => '產品成份 - 比利時65%巧克力、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '6' => [
                    'user_id' => 1,
                    'product_name' => '黑色派對-9球',
                    'product_main_category' => 1,
                    'product_category' => '@#2@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/007.jpg',
                    'product_content' => '松露巧克力、小榛果巧克力、黑森林巧克力、餅乾巧克力、覆盆子巧克力、堅果白巧克力，共9球、緞帶、提袋',
                    'product_description' => '每次的派對都可以有不同的驚喜，可以極簡的幽默，也可以是華麗的爆笑。在每次的驚喜揭開之前，懸疑的氣氛彷彿是一張黑色絲綢裹著層層的未知，而當絲綢滑落的那一剎那，整個派對似乎都搭著火箭衝向月球。',
                    'product_specification' => '產品成份 - 比利時巧克力、法國巧克力、動物性鮮奶油、法國奶油、榛果粒、榛果醬、杏仁條、杏桃乾、開心果、蔓越莓乾、橘香條、餅乾脆片、玫瑰包種茶葉、酒、可可粉、覆盆子粉<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '7' => [
                    'user_id' => 1,
                    'product_name' => '黑色派對-16球',
                    'product_main_category' => 1,
                    'product_category' => '@#2@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/008.jpg',
                    'product_content' => '松露巧克力、小榛果巧克力、黑森林巧克力、餅乾巧克力、覆盆子巧克力、堅果白巧克力，共16球，緞帶、提袋',
                    'product_description' => '每次的派對都可以有不同的驚喜，可以極簡的幽默，也可以是華麗的爆笑。在每次的驚喜揭開之前，懸疑的氣氛彷彿是一張黑色絲綢裹著層層的未知，而當絲綢滑落的那一剎那，整個派對似乎都搭著火箭衝向月球。這一款巧克力，彷彿是隨著季節不斷輪替的黑色派對，像是一個幸運盒子，每次開盒都有不同的驚喜，松露、覆盆子巧克力、黑森林、餅乾巧克力輪番上演，是最盛麗的巧克力派對。',
                    'product_specification' => '產品成份 - 比利時巧克力、法國巧克力、動物性鮮奶油、法國奶油、榛果粒、榛果醬、杏仁條、杏桃乾、開心果、蔓越莓乾、橘香條、餅乾脆片、玫瑰包種茶葉、酒、可可粉、覆盆子粉<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '8' => [
                    'user_id' => 1,
                    'product_name' => '松露70%',
                    'product_main_category' => 1,
                    'product_category' => '@#2@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/009.jpg',
                    'product_content' => '松露巧克力20球、緞帶、提袋',
                    'product_description' => '是該休息的時候了，已經連續加班了一個星期，在週末夜裡，我想給你一個完美又甜蜜的句點。我想坐在你的辦公桌旁，跟你分享Chochoco的松露，柔滑的比利時巧克力裹在Cacao Barry微帶煙燻味的可可粉中，甚至，在比利時巧克力的內裡，也滲進了Cacao Barry的可可粉，一種華麗又迷濛的香氣，從這個松露的圓球裡不住向外擴散…就是這種氣味，在你掩上卷宗後，畫下一個華麗的句點，隨我走進夜晚的大街，一起回家！',
                    'product_specification' => '產品成份 - 比利時70%醇苦巧克力、60%苦甜巧克力、法國可可粉、法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '9' => [
                    'user_id' => 1,
                    'product_name' => '黑森林70%',
                    'product_main_category' => 1,
                    'product_category' => '@#2@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/010.jpg',
                    'product_content' => '黑森林巧克力16球、緞帶、提袋',
                    'product_description' => '以70%的法國巧克力揉成，外層以削薄的巧克力片包覆， 彷彿在巧克力森林裡拾起的馥郁果實， 具有強烈法國巧克力富含果酸和果香的巧克力特色。',
                    'product_specification' => '產品成份 - 法國巧克力、 法國鮮奶油、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '10' => [
                    'user_id' => 1,
                    'product_name' => '小榛果巧克力%',
                    'product_main_category' => 1,
                    'product_category' => '@#2@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/011.jpg',
                    'product_content' => '小榛果巧克力15球、緞帶、提袋',
                    'product_description' => '當你開始迷戀Truffle的時候，或許你也應該試試，我帶來的Chochoco特製小榛果巧克力。在飽滿的球體之中，裹著細心烤香的榛果粒，外層再細細敷上法國進口的可可粉，在唇齒之間，口感爽脆的榛果粒，在口中敲擊著一種快感，軟滑如絲綢的比利時巧克力綿長有如小提琴的琴音，最後進入主題的是細緻的可可粉，彷彿豎琴一般細瑣的琴音紛紛在你口中到來。我在送給你這款巧克力的時候，也希望讓你品嚐到口中樂音的交響。',
                    'product_specification' => '產品成份 - 比利時70%醇苦巧克力、榛果粒，比利時無糖100%純天然榛果醬、微量酒 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '11' => [
                    'user_id' => 1,
                    'product_name' => '法式水果棉花糖-25片',
                    'product_main_category' => 1,
                    'product_category' => '@#3@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/012.jpg',
                    'product_content' => '法式棉花糖25片裝、緞帶、提袋',
                    'product_description' => '我記得你跟我說過，小時候第一次吃棉花糖的滋味，你說，就像天空中的雲朵在你的口中融化，你想像中的天堂，就是那個樣子。我想給你一座更華麗的天堂，所以我找到了chochoco這款法國水果棉花糖，輕飄飄又粉嫩的棉花糖，拈在手裡似乎真的一點重量都沒有，放進口中，法國Boiron天然果泥，從軟綿綿的雲層中流洩出來，口中漂浮的香氣似乎也帶著你和夢想起飛～豔陽柑橙、酸甜覆盆子，就像晚霞染上了雲朵一般，彷彿你可以品味到燦爛金光的味道。',
                    'product_specification' => '產品成份 - 法國Boiron天然果泥、砂糖、微量吉利丁 (葷食)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 常溫保存兩週',
                    'is_popular' => 0,
                ],
                '12' => [
                    'user_id' => 1,
                    'product_name' => '法式水果棉花糖-49片',
                    'product_main_category' => 1,
                    'product_category' => '@#3@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/013.jpg',
                    'product_content' => '綜合口味馬卡龍9入、緞帶、提袋',
                    'product_description' => '精選熱門口味佐以法國巧克力與蛋白餅如夢似幻的顏色<br><br>交織出巴黎的浪漫<br>四種口味│<br><br>安特斯白巧克力黑芝麻(藍色)<br><br>吉瓦納牛奶巧克力焦糖(白色)<br><br>聖多明尼克巧克力鹽之花 (粉紅色)<br><br>歐帕納斯白巧克力檸檬(黃色)',
                    'product_specification' => '產品成份 - 巧克力、鮮奶油、鹽之花、果泥、黑芝麻、雞蛋、糖、食用色素 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '13' => [
                    'user_id' => 1,
                    'product_name' => '巧克力馬卡龍',
                    'product_main_category' => 1,
                    'product_category' => '@#3@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/014.jpg',
                    'product_content' => '綜合口味馬卡龍9入、緞帶、提袋',
                    'product_description' => '精選熱門口味佐以法國巧克力與蛋白餅如夢似幻的顏色<br><br>交織出巴黎的浪漫<br>四種口味│<br><br>安特斯白巧克力黑芝麻(藍色)<br><br>吉瓦納牛奶巧克力焦糖(白色)<br><br>聖多明尼克巧克力鹽之花 (粉紅色)<br><br>歐帕納斯白巧克力檸檬(黃色)',
                    'product_specification' => '產品成份 - 巧克力、鮮奶油、鹽之花、果泥、黑芝麻、雞蛋、糖、食用色素 (蛋奶素)<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '14' => [
                    'user_id' => 1,
                    'product_name' => '法式水果軟糖-25片',
                    'product_main_category' => 1,
                    'product_category' => '@#3@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/015.jpg',
                    'product_content' => '法式水果軟糖25片、緞帶、提袋',
                    'product_description' => '當我在chochoco的玻璃櫃中看見這幾款軟糖，我就想起了當你第一次帶上BVLGARI彩色寶石戒指的神情，我忍不住再買下這一盒繽紛如BVLGARI的法式水果軟糖，因為，我想再看一次，你那樣的表情！這幾款法式水果軟糖，從血橙、多酚黑醋栗以及熱帶水果，在咬下去的同時，天然果膠的Q彈口感和Boiron果泥嫩滑的口感交互出現，天然的水果香氣彷彿一道夏日微風，拂過身體的每個細胞。我想看見你吃下這些繽紛的chochoco法式水果軟糖，我想看見你的瞇著眼睛享受的表情，我想看你在百分之百的純天然水果香氣中，燦爛地微笑！',
                    'product_specification' => '產品成份 - 法國Boiron天然果泥、砂糖、微量酒<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 常溫保存兩週',
                    'is_popular' => 0,
                ],
                '15' => [
                    'user_id' => 1,
                    'product_name' => '法式水果軟糖-49片',
                    'product_main_category' => 1,
                    'product_category' => '@#3@#',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/016.jpg',
                    'product_content' => '法式水果軟糖49片、緞帶、提袋',
                    'product_description' => '當我在chochoco的玻璃櫃中看見這幾款軟糖，我就想起了當你第一次帶上BVLGARI彩色寶石戒指的神情，我忍不住再買下這一盒繽紛如BVLGARI的法式水果軟糖，因為，我想再看一次，你那樣的表情！ 這幾款法式水果軟糖，從血橙、多酚黑醋栗以及熱帶水果，在咬下去的同時，天然果膠的Q彈口感和Boiron果泥嫩滑的口感交互出現，天然的水果香氣彷彿一道夏日微風，拂過身體的每個細胞。我想看見你吃下這些繽紛的chochoco法式水果軟糖，我想看見你的瞇著眼睛享受的表情，我想看你在百分之百的純天然水果香氣中，燦爛地微笑！',
                    'product_specification' => '產品成份 - 法國Boiron天然果泥、砂糖、微量酒<br>品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用<br>訂購需知 - 常溫保存兩週',
                    'is_popular' => 0,
                ],
                '16' => [
                    'user_id' => 1,
                    'product_name' => '皇家古典巧克力蛋糕',
                    'product_main_category' => 2,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/cake-001.jpg',
                    'product_content' => '皇家古典巧克力蛋糕/6吋、緞帶、提袋、蛋糕刀、盤叉5入、造型蠟燭',
                    'product_description' => '在繁花盛開的新世紀，許多事情越來越輕薄的毫無重量，輕薄的裝飾取代了厚重的本質，在轉過許多生命的彎曲後，我開始靜下心來想與你分享的是眼前的皇家古典蛋糕。 沒有太多浮華的裝飾，杏仁粉以誠意十足的比例拌和在麵粉之中，誠意使得眼前的蛋糕紮實而濕潤，醇厚的巧克力淋醬沿著蛋糕的邊緣汨汨流下，在新鮮時分進入口中，我似乎還可以感覺到那嬌嫩的彈性…',
                    'product_specification' => '產品成份 -比利時70%巧克力、香檳巧克力、法國鮮奶油、杏仁粉、日本麵粉 (蛋奶素) 品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用 訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '17' => [
                    'user_id' => 1,
                    'product_name' => '女王緞帶巧克力蛋糕',
                    'product_main_category' => 2,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/cake-002.jpg',
                    'product_content' => '女王緞帶巧克力蛋糕6吋、緞帶、提袋、蛋糕刀、盤叉5入、造型蠟燭',
                    'product_description' => '蛋糕特有的三層色彩 就像巴黎薇薇安拱廊街的優雅身段 第一層 歐帕納斯白巧克力 第二層 普雷牛奶巧克力 第三層 普艾瑪黑巧克力 第四層 法國手指餅乾蛋糕 蛋糕品嚐時有如冰淇淋，四層濃郁巧克力蛋糕在口中化開...',
                    'product_specification' => '產品成份 - 法國巧克力、比利時巧克力、法國鮮奶油、日本麵粉、糖、雞蛋、微量吉利丁(葷食) 品味方式 - 建議放置室溫回溫10-15分鐘後品嚐，並搭配黑咖啡或熱紅茶，慢慢品嘗享用 訂購需知 - 為保持最佳口感，請「冷凍」保存一週。',
                    'is_popular' => 0,
                ],
                '18' => [
                    'user_id' => 1,
                    'product_name' => '小布朗尼',
                    'product_main_category' => 2,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/cake-003.jpg',
                    'product_content' => '小布朗尼蛋糕35球、鐵罐、提袋',
                    'product_description' => '小布朗尼在你五歲的時候，你最喜歡吃蛋糕；當你十五歲的時候，你最喜歡的還是蛋糕；當你二十五歲，每天在辦公室挑燈夜戰、埋首工作的時候，我知道你最渴望的還是蛋糕。所以我捎上了這一款小布朗尼給你，以一口為尺度打造的迷你蛋糕，混融著70%的比利時巧克力以及100%可可膏，可以用優雅的姿勢一口氣吞進所有的巧克力氣息！',
                    'product_specification' => '產品成份 - 比利時70%巧克力、法國100%可可膏、日本麵粉、法國鮮奶油、法國鹽之花 (蛋奶素) 品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用 訂購需知 - 冷藏保存一週',
                    'is_popular' => 1,
                ],
                '19' => [
                    'user_id' => 1,
                    'product_name' => '搖滾生巧克力蛋糕',
                    'product_main_category' => 2,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/cake-004.jpg',
                    'product_content' => '搖滾生巧克力蛋糕、緞帶、提袋',
                    'product_description' => '生巧克力蛋糕，純綷巧克力，只有巧克力，沒有一滴麵粉。傳說.....茂密深處的熱帶雨林中，原始住民們與可可一起呼吸一起成長，吸收陽光、空氣、水，可可是他們的飲料，是他們的點心，也是營養的來源，是歡樂之源，他們是重度使用者....歡迎加入巧克力重度使用者俱樂部！',
                    'product_specification' => '產品成份 - 黑巧克力70％ 、法國鮮奶油、白蘭地酒、雞蛋、微量莎娜丁粉 (葷) 品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用 訂購需知 - 冷藏保存一週',
                    'is_popular' => 0,
                ],
                '20' => [
                    'user_id' => 1,
                    'product_name' => '法式生巧克力蛋糕捲70%',
                    'product_main_category' => 2,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/cake-005.jpg',
                    'product_content' => '法式生巧克力蛋糕捲、緞帶、提袋',
                    'product_description' => '比利時生巧克力 X 濃厚香堤拉巧克力內餡 X 日本戚風蛋糕 吃完這款法式生巧克力蛋糕捲 那種滲透到內心深處的新鮮感覺 彷彿為明天提供滿滿元氣 全新蛋糕，全新好心情',
                    'product_specification' => '產品成份 - 法國巧克力、比利時巧克力、法國鮮奶油、雞蛋、日本麵粉(蛋奶素) 品味方式 - 搭配黑咖啡或熱紅茶，慢慢品嘗享用 訂購需知 - 冷藏保存4天',
                    'is_popular' => 0,
                ],
                '21' => [
                    'user_id' => 1,
                    'product_name' => '金寶貝生巧克力蛋糕',
                    'product_main_category' => 3,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/miyuki-cake-001.jpg',
                    'product_content' => '生巧克力蛋糕，鍛帶，提袋',
                    'product_description' => '巧克力 X 巧克力 X 巧克力 純粹巧克力，沒有一滴麵粉 大量的70%黑巧克力製成的蛋糕 並加入微微的法國白蘭地提味 香濃不甜膩的滋味 會是開心迎接新生命的最佳選擇',
                    'product_specification' => '產品成分：黑巧克力70％ 、法國奶油、白蘭地酒、雞蛋 、微量莎娜丁粉 (葷) 保存方式：冷藏一周 (冷凍保存，口感特殊)',
                    'is_popular' => 0,
                ],
                '22' => [
                    'user_id' => 1,
                    'product_name' => '蔓越莓檸檬蛋糕',
                    'product_main_category' => 3,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/miyuki-cake-002.jpg',
                    'product_content' => '蔓越莓檸檬蛋糕，鍛帶，提袋',
                    'product_description' => '檸檬汁 X 蔓越莓 X 瑪德蓮蛋糕 新鮮檸檬汁 搭配酸甜莓果 最後表層淋上優雅糖霜 酸酸甜甜幸福滋味 一款最經典的彌月蛋糕',
                    'product_specification' => '產品成分：新鮮檸檬汁、蔓越莓、萊姆酒、日本麵粉、殺菌雞蛋、法國奶油 (蛋奶素) 保存方式：冷藏一周',
                    'is_popular' => 0,
                ],
                '23' => [
                    'user_id' => 1,
                    'product_name' => '法式生巧克力蛋糕捲',
                    'product_main_category' => 3,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/miyuki-cake-003.jpg',
                    'product_content' => '法式生巧克力蛋糕捲，鍛帶，提袋',
                    'product_description' => '生巧克力 X 香堤拉巧克力內餡 X 戚風蛋糕 巧克力與奶油做成內餡 並鋪上生巧克力塊 戚風蛋糕把它們層層包圍 展現不同層次巧克力風味 彷彿為每天提供滿滿元氣',
                    'product_specification' => '產品成分：法國巧克力、比利時巧克力、法國鮮奶油、雞蛋、日本麵粉 (蛋奶素) 保存方式：最佳賞味期限4天，需冷藏確保品質',
                    'is_popular' => 0,
                ],
                '24' => [
                    'user_id' => 1,
                    'product_name' => '巧克力脆片生乳酪捲',
                    'product_main_category' => 3,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/miyuki-cake-004.jpg',
                    'product_content' => '巧克力脆片生乳酪捲，鍛帶，提袋',
                    'product_description' => '法國巧克力64％ X 香濃乳酪 X 日本鮮奶油 日本戚風蛋糕溫柔包覆著 完美比例調和的法國乳酪 以及日本清爽鮮奶油內餡 中間再撒上巧克力脆片 濃郁細緻的口感中藏有脆脆地小驚喜',
                    'product_specification' => '產品成分：法國巧克力64％、法國乳酪、日本鮮奶油、認證雞蛋、日本麵粉 (蛋奶素) 保存方式：需冷藏，賞味期限4天(冷凍保存，獨特冰淇淋口感)',
                    'is_popular' => 1,
                ],
                '25' => [
                    'user_id' => 1,
                    'product_name' => '超濃厚巧克力塊蛋糕',
                    'product_main_category' => 3,
                    'product_category' => '',
                    'product_quantity' => rand(1,50),
                    'product_price' => rand(1,1000),
                    'product_img' => 'product_img/miyuki-cake-005.jpg',
                    'product_content' => '超濃厚巧克力塊蛋糕，鍛帶，提袋',
                    'product_description' => '巧克力 X 巧克力塊 X 磅蛋糕 巧克力豪邁切塊 配上chochoco特製巧克力蛋糕體 在底部還有一層脆脆地糖霜驚喜 濃郁巧克力一層又一層…',
                    'product_specification' => '產品成分：比利時巧克力、 法國巧克力、日本麵粉、 殺菌雞蛋、 法國奶油、 白蘭地酒 (蛋奶素) 保存方式：冷藏一周',
                    'is_popular' => 0,
                ],
            ];

            foreach($products as $product_key => $product_val){
                Products::factory()->create([
                    'user_id' => $product_val['user_id'],
                    'product_name' => $product_val['product_name'],
                    'product_main_category' => $product_val['product_main_category'],
                    'product_category' => $product_val['product_category'],
                    'product_quantity' => 1000,
                    'product_price' => $product_val['product_price'],
                    'product_img' => $product_val['product_img'],
                    'product_content' => $product_val['product_content'],
                    'product_description' => $product_val['product_description'],
                    'product_specification' => $product_val['product_specification'],
                    'is_popular' => $product_val['is_popular'],
                    'is_show' => 1

                ]);
            }

            $product_category = [
                '生巧克力',
                '松露',
                '珠寶盒',
            ];

            foreach($product_category as $name){
                ProductCategorys::factory()->create([
                    'category_name' => $name
                ]);
            }
        //商品管理 END

        //會員管理 START
            $members = [
                '0' => [
                    'member_name'       => 'test_member1',
                    'member_email'      => 'test1@mail.com',
                    'member_phone'      => '0922123123',
                    'member_birth'      => '2022/09/29',
                    'member_password'   => 'test1234',
                    'member_realname'   => '測試會員',
                    'member_gender'     => '1',
                    
                ]
            ];

            foreach($members as $member_key => $member_val){
                Members::factory()->create([
                    'member_name'       => $member_val['member_name'],
                    'member_email'      => $member_val['member_email'],
                    'member_phone'      => $member_val['member_phone'],
                    'member_birth'      => $member_val['member_birth'],
                    'member_password'   => $member_val['member_password'],
                    'member_realname'   => $member_val['member_realname'],
                    'member_gender'     => $member_val['member_gender'],
                ]);
            }
        //會員管理 END

        //會員地址 START

            $member_addresses = [
                '0' => [
                    'member_id' => '1',
                    'zipcode'   => '220',
                    'city'      => '新北市',
                    'area'      => '板橋區',
                    'address'   => '重慶路247號12樓',
                    'addressee' => '王曉明'
                ],
                '1' => [
                    'member_id' => '1',
                    'zipcode'   => '248',
                    'city'      => '新北市',
                    'area'      => '新莊區',
                    'address'   => '幸福路723號',
                    'addressee' => '陳大華'
                ]
            ];
            foreach($member_addresses as $member_address_key => $member_address_val){
                MemberAddresses::factory()->create([
                    'member_id' => $member_address_val['member_id'],
                    'zipcode'   => $member_address_val['zipcode'],
                    'city'      => $member_address_val['city'],
                    'area'      => $member_address_val['area'],
                    'address'   => $member_address_val['address'],
                    'addressee' => $member_address_val['addressee'],
                ]);
            }
        //會員地址 END

        //訂單管理 START
            $orders = [];

            foreach($orders as $order_key => $order_val){
                // Orders::factory()->create([
                //     '' => $order_val[''],
                // ]);
            }
        //訂單管理 END

    }
        
}
