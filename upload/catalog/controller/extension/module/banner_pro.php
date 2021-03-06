<?php
class ControllerExtensionModuleBannerPro extends Controller
{
        public function index($setting)
        {
                static $module = 0;

                $this->load->language('extension/module/banner_pro');
                $this->load->model('extension/module/banner_pro');
                //$this->load->model('tool/image');

                $this->document->addStyle('catalog/view/javascript/jquery/swiper/css/swiper.min.css');
                $this->document->addStyle('catalog/view/javascript/jquery/swiper/css/opencart.css');
                $this->document->addScript('catalog/view/javascript/jquery/swiper/js/swiper.jquery.js');

                $data['banners'] = array();

                $results = $this->model_extension_module_banner_pro->getBanner($setting['banner_id']);
                $host = HTTPS_SERVER ? HTTPS_SERVER : HTTP_SERVER;
                foreach ($results as $result) {
                        /*   if (is_file(DIR_IMAGE . $result['image'])) { */
                        $data['banners'][] = array(
                                'title'      => $result['title'],
                                'subtitle'      => $result['subtitle'],
                                'description'      => $result['description'],
                                'link1'       => $result['link1'],
                                'label1'      => $result['label1'],
                                'link2'      => $result['link2'],
                                'label2'       => $result['label2'],
                                'video'      => $result['video'],
                                'image' =>  $host.'image/'.$result['image']
                        );
                        /*    } */
                }

                $data['module'] = $module++;

                return $this->load->view("extension/module/" . $setting['layout'], $data);
        }
}
