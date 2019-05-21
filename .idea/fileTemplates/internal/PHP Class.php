<?
declare(strict_types=1);

#if (${NAMESPACE})

namespace ${NAMESPACE};

#end

#if($NAME.endsWith("Interface"))
#parse("PhpInterface")
#elseif($NAME.endsWith("Exception"))
#parse("Exception")
#else
#parse("PhpClass")
#end