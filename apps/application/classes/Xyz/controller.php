<?php

/**
 *
 *
 *
 */
class Xyz_Controller extends Controller
{

    public $_data = array();

    public $params = array();

    /**
     * before
     */
    public function before()
    {
        $params = $this->request->param('params');
        $this->params = $this->analyze_param($params);
        $controller = $this->request->controller();
        $action = $this->request->action();
    }

    /**
     * 显示模板
     * @param string $tpl ,模板名
     *
     */
    public function display($tpl)
    {
        $file = '';

        if (!file_exists(APPPATH . '/views/' . $GLOBALS['cfg_templet'] . '/' . $tpl . '.tpl')) {
            $file = 'default/' . $tpl;
        }

        $view = Xyz_View::factory($file);

        foreach ($this->_data as $key => $value) {
            $view->set($key, $value);
        }

        $this->response->body($view->render());
    }

    /**
     * 模板赋值,控制器赋值
     * @param string $key
     * @param string $value
     */
    public function assign($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * 变量值分析器
     * @param string $param
     * @return array
     */
    public function analyze_param($param)
    {
        $arr = explode('/', $param);
        $out = array();

        for ($i = 0; isset($arr[$i]); $i = $i + 1) {
            if ($i % 2 == 0) {
                $key = $arr[$i];
                $value = isset($arr[$i + 1]) ? $arr[$i + 1] : 0;
                $out[$key] = $value;
            }
        }

        return $out;
    }
} 
