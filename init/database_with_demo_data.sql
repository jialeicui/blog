# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.20)
# Database: blog
# Generation Time: 2014-11-03 08:05:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table about
# ------------------------------------------------------------

DROP TABLE IF EXISTS `about`;

CREATE TABLE `about` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;

INSERT INTO `about` (`id`, `img`, `name`, `href`)
VALUES
	(1,'style/img/github','','http://github.com/jialeicui'),
	(2,'style/img/weibo','','http://weibo.com/u/1747644287'),
	(3,'style/img/email','','mailto:jialeicui@126.com');

/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;

INSERT INTO `blog` (`id`, `title`, `content`)
VALUES
	(1,'hugepage','以1G的大页为例  \n\n检查是否可以配置1G的大页\n\n```\ncat /proc/cpuinfo | grep pdpe1gb\n```\n如果有任何输出,说明可以配置\n\n编辑`/etc/grub.conf`,在默认启动项的**kernel**行增加下面的代码\n\n```\ntransparent_hugepage=never hugepagesz=1G hugepages=1 default_hugepagesz=1G\n```\n\n重启之后看结果\n\n```\n#  grep Huge /proc/meminfo\nHugePages_Total:       1\nHugePages_Free:        1\nHugePages_Rsvd:        0\nHugePages_Surp:        0\nHugepagesize:    1048576 kB\n#\n```'),
	(2,'fdir配置','####首先要确认网卡是否支持flow director\n[82599 datasheet](http://www.intel.com/content/dam/www/public/us/en/documents/datasheets/82599-10-gbe-controller-datasheet.pdf)  \n\n7.1.2.7 的介绍  \n82599支持perfect-match的表项个数为8K\n\n####使用dpdk自带的testpmd测试该功能\n由于dpdk的example中没有fdir相关的例子,所以没有代码参考.  \n查找[testpmd手册](http://www.dpdk.org/doc/intel/dpdk-testpmd-app-1.7.0.pdf)  \n该程序支持dir相关的命令行配置  \n\n* 启动:参数中要是能fdir, 例如`sudo ./testpmd -c 0x0f -n 2 -m 512 -- -i --portmask=0x3 --nb-cores=2 --pkt-filter-mode=signature --rxq=2 --txq=2`\n* 配置参数: `help flowdir`可以显示相关的命令行, 参考帮助, 配置如下\n\n ```\nadd_signature_filter 0 ip src 2.1.1.2 22 dst 2.1.1.3 53 flexbytes 0 vlan 0 queue 1\nset_masks_filter 0 only_ip_flow 0 src_mask 0xffffffff 0 dst_mask 0 0 flexbytes 0 vlan_id 0 vlan_prio 0\n ```\n打入源ip为2.1.1.2的流量, 在testpmd中`show  port stats  all`, 全都是fdirmiss, 没有一个match, 多次更改配置, 无果.尝试其他的测试方法.\n\n####使用原生驱动测试\n搜索资料, [一篇文档](https://www.kernel.org/doc/Documentation/networking/ixgbe.txt) 中有如下描述\n\n```\nYou can verify that the driver is using Flow Director by looking at the counter\nin ethtool: fdir_miss and fdir_match.\n\nOther ethtool Commands:\nTo enable Flow Director\n    ethtool -K ethX ntuple on\nTo add a filter\n    Use -U switch. e.g., ethtool -U ethX flow-type tcp4 src-ip 0x178000a\n        action 1\nTo see the list of filters currently present:\n    ethtool -u ethX\n```\n\n尝试\n\n1. ethtool -K eth2 ntuple on\n2. ethtool -u eth2  \n36 RX rings available  \nTotal 0 rules  \n3. ethtool -U eth2 flow-type ip4 src-ip 2.1.1.2 action 1  \nAdded rule with ID 2045\n4. ethtool -u eth2  \n36 RX rings available  \nTotal 1 rules\n\n```\nFilter: 2045  \n    Rule Type: Raw IPv4  \n    Src IP addr: 2.1.1.2 mask: 0.0.0.0\n    Dest IP addr: 0.0.0.0 mask: 255.255.255.255\n    TOS: 0x0 mask: 0xff\n    Protocol: 0 mask: 0xff\n    L4 bytes: 0x0 mask: 0xffffffff\n    VLAN EtherType: 0x0 mask: 0xffff\n    VLAN: 0x0 mask: 0xffff\n    User-defined: 0x0 mask: 0xffffffffffffffff\n    Action: Direct to queue 1\n```\n从2.1.1.2 ping本机, 查看, 已经生效:\n\n```\nethtool -S eth2 | grep fdir\n     fdir_match: 5\n     fdir_miss: 0\n```\n####查看原生驱动与DPDK的区别\n既然原生驱动生效, dpdk不生效, 那么比较一下两者的不同.  \n查看一下原生驱动下发动作[ixgbe_set_rx_ntuple](http://lxr.free-electrons.com/source/drivers/net/ixgbe/ixgbe_ethtool.c?v=3.0#L2338)  \n以及[dpdk中的处理](http://www.dpdk.org/browse/dpdk/tree/lib/librte_pmd_ixgbe/ixgbe_fdir.c?h=1.5.0)  \n发现以下不同\n\n|原生驱动|testpmd中的下发|  \n|---|---|  \n|先下发mask|后下发|\n|下发的rule和mask进行了与操作,再下发硬件|没有考虑|\n|mask中的1代表忽略|mask中的1代表不忽略|\n|ntuple使能是下发的perfect-match规则|下发的signature规则|\n\n对比完不同之后,写代码实现,并进行测试, 成功\n\n```CPP\nport_conf.fdir_conf.mode = RTE_FDIR_MODE_PERFECT;\nport_conf.fdir_conf.pballoc = RTE_FDIR_PBALLOC_64K;\nport_conf.fdir_conf.status = RTE_FDIR_REPORT_STATUS;\nport_conf.fdir_conf.flexbytes_offset = 0x6;\nport_conf.fdir_conf.drop_queue = 127;\n    \nvoid init_fdir()\n{\n    int rv;\n\n    struct rte_fdir_masks fdir_masks;\n    memset(&fdir_masks, 0, sizeof(struct rte_fdir_masks));\n    fdir_masks.only_ip_flow = 1;\n    fdir_masks.src_ipv4_mask = -1;\n    rv = rte_eth_dev_fdir_set_masks(0, &fdir_masks);\n    if (rv != 0)\n    {\n        printf(\"set mask fail\\n\");\n    }\n\n    struct rte_fdir_filter fdir_filter;\n    memset(&fdir_filter, 0, sizeof(struct rte_fdir_filter));\n    fdir_filter.ip_src.ipv4_addr = ntohl(inet_addr(\"2.1.1.2\"));\n    rv = rte_eth_dev_fdir_add_perfect_filter(0, &fdir_filter, 0, 7, 0);\n    if (rv != 0)\n    {\n        printf(\"set rule fail\\n\");\n    }\n}\n```\n\n\n\n\n\n'),
	(3,'javascript笔记','\n#####数据类型\n\n* 简单数据类型的数值放在栈中\n* 复杂数据类型地址放在栈中, 数据放在堆中  (object)\n\ntypeof返回的结果, 不是很有用\n\n如果要更加准确的拿到type, 参考实现\n\n```\nfunction objtype(obj){\n	return object.prototype.toString.call(ojb).slice(8, -1);\n}\n```\n\n#####数组\n\n```\nvar myarr = [\"a\", \"b\"];\n```\n\n常用函数  \n\n* toString\n* toLocaleString  //过时\n* join\n* shift\n* unshift\n* pop\n* push\n* concat\n* slice\n* reverse\n* sort\n* splice\n\n\n#####object\n是一组k-v集合  \ndelete 来删除obj里面的property  \n*构造函数一般大写*  \n######function对象\n\n#####传值和传址\n数字/字符串/bool -> 传值  其他 传地址\n\n#####闭包\n引用相关\n\n#####DOM事件流\n* 捕获型 -> 所有的都走\n* 冒泡型 -> focus blur\n\n事件监听器\n\nIE|Element.attachEvent(\"onclick\", func)  \n-|-  \nDOM标准|Element.attachEvent(\"click\", func, false)\n\njsonp  **跨域问题**\n\n\n#####进阶\n* prototype\n* 块级作用域(闭包实现)\n* 作用域链\n* call & apply\n');

/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
