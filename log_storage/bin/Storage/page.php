<?php
/**
 * Created by PhpStorm.
 * User: eson
 * Date: 2018/11/15
 * Time: 下午10:09
 */

namespace Storage;

class page
{
    private $total;          //总记录数
    private $size;           //一页显示的记录数
    private $page;           //当前页
    private $page_count;     //总页数
    private $start_page;              //起头页数
    private $end_page;             //结尾页数
    private $url;            //获取当前的url
    /*
     * $show_pages
     * 页面显示的格式，显示链接的页数为2*$show_pages+1。
     * 如$show_pages=2那么页面上显示就是[首页] [上页] 1 2 3 4 5 [下页] [尾页]
     */
    private $show_pages;

    public function __construct ($total = 1, $size = 1, $page = 1, $url, $show_pages = 2)
    {
        $this->total = $this->numeric($total);
        $this->size = $this->numeric($size);
        $this->page = $this->numeric($page);
        $this->page_count = ceil($this->total / $this->size);
        $this->url = $url;
        if ($this->total < 0)
            $this->total = 0;
        if ($this->page < 1)
            $this->page = 1;
        if ($this->page_count < 1)
            $this->page_count = 1;
        if ($this->page > $this->page_count)
            $this->page = $this->page_count;
        $this->limit = ($this->page - 1) * $this->size;
        $this->start_page = $this->page - $show_pages;
        $this->end_page = $this->page + $show_pages;
        if ($this->start_page < 1) {
            $this->end_page = $this->end_page + (1 - $this->start_page);
            $this->start_page = 1;
        }
        if ($this->end_page > $this->page_count) {
            $this->start_page = $this->start_page - ($this->end_page - $this->page_count);
            $this->end_page = $this->page_count;
        }
        if ($this->start_page < 1)
            $this->start_page = 1;
    }

    //检测是否为数字
    private function numeric ($num)
    {
        if (strlen($num)) {
            if (!preg_match("/^[0-9]+$/", $num)) {
                $num = 1;
            } else {
                $num = substr($num, 0, 11);
            }
        } else {
            $num = 1;
        }
        return $num;
    }

    //地址替换
    private function page_replace ($page)
    {
        return str_replace("{page}", $page, $this->url);
    }

    //首页
    private function myde_home ()
    {
        if ($this->page != 1) {
            return "<a href='" . $this->page_replace(1) . "' title='首页'>首页</a>";
        } else {
            return "<span>首页</span>";
        }
    }

    //上一页
    private function myde_prev ()
    {
        if ($this->page != 1) {
            return "<a href='" . $this->page_replace($this->page - 1) . "' title='上一页'>上一页</a>";
        } else {
            return "<span>上一页</span>";
        }
    }

    //下一页
    private function myde_next ()
    {
        if ($this->page != $this->page_count) {
            return "<a href='" . $this->page_replace($this->page + 1) . "' title='下一页'>下一页</a>";
        } else {
            return "<span>下一页</span>";
        }
    }

    //尾页
    private function myde_last ()
    {
        if ($this->page != $this->page_count) {
            return "<a href='" . $this->page_replace($this->page_count) . "' title='尾页'>尾页</a>";
        } else {
            return "<span>尾页</span>";
        }
    }

    //输出
    public function myde_write ($id = 'page')
    {
        $str = "<div id=" . $id . ">";
        $str .= $this->myde_home();
        $str .= $this->myde_prev();
        if ($this->start_page > 1) {
            $str .= "<span class='pageEllipsis'>...</span>";
        }
        for ($i = $this->start_page; $i <= $this->end_page; $i++) {
            if ($i == $this->page) {
                $str .= "<a href='" . $this->page_replace($i) . "' title='第" . $i . "页' class='cur'>$i</a>";
            } else {
                $str .= "<a href='" . $this->page_replace($i) . "' title='第" . $i . "页'>$i</a>";
            }
        }
        if ($this->end_page < $this->page_count) {
            $str .= "<span class='pageEllipsis'>...</span>";
        }
        $str .= $this->myde_next();
        $str .= $this->myde_last();
        $str .= "<span class='pageRemark'>共<b>" . $this->page_count .
            "</b>页<b>" . $this->total . "</b>条数据</span>";
        $str .= "</div>";
        return $str;
    }
}