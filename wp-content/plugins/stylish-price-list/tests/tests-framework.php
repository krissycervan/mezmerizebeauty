<?php
if(!function_exists('c9t_is_passed_or_failed')){
    function c9t_is_passed_or_failed($actual,$expected,$testcase_name){
        ob_start();
        ?>
        <div>
        <?php if($actual == $expected): ?>
            <h3 style="color:green"> <?php echo $testcase_name; ?> is passed!</h3>
            <p><pre> <?php var_dump($actual); ?> </pre></p>
        <?php else: ?>
            <h3 style="color:red"> <?php echo $testcase_name; ?> is failed!</h3>
            <p>expected :<br/><pre> <?php var_dump($expected); ?> </pre></p>
            <p>actual :<br/><pre> <?php var_dump($actual); ?> </pre></p>
            <p>diff :<br/><pre> <?php $result = array_diff_assoc($actual, $expected); var_dump($result); ?> </pre></p>
        <?php endif;//end $actual==$expected ?>
        </div>
        <?php
        $html=ob_get_clean();
        return $html;
    }
}//end if !function_exists('c9t_is_passed_or_failed')
