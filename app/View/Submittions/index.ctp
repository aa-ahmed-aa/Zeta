<div class="problems index">
    <h1 style="font-size:30px;"><?php echo __('Scoreboard'); ?></h1><br>
    <table class="table table-hover">
        <thead>
        <tr>
            <th><?php echo '#'; ?></th>
            <th><?php echo '#Team'; ?></th>
            <?php foreach ($problems as $problem): ?>
                <th>
                    <?php echo h($problem['Problem']['name']); ?>
                </th>
            <?php endforeach; ?>

            <th><?php echo 'Time' ?></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($submitions as $row): ?>
            <tr style="font-weight: bold;<?= ($row['user_id'] == AuthComponent::user('id') ? "background-color: rgb(156, 201, 22);" : '' ); ?>">

                    <td><?= $row['user_id']; ?></td>
                    <td><?= $row['user_name']; ?></td>
                    <?php foreach($row['problems'] as $problem) : ?>
                         <?php
                            if($problem['response'] == "Accepted")
                            {
                                $problem['response'] = "AC";
                                $color = "color: #027901;";
                            }
                            else if($problem['response'] == "Compiler Error")
                            {
                                $problem['response'] = "CE";
                                $color = "color: #000000;";
                            }
                            else if($problem['response'] == "Wrong Answer")
                            {
                                $problem['response'] = "WA";
                                $color = "color: #d20e00;";
                            }
                            else if($problem['response'] == "Time Limit Exceed")
                            {
                                $problem['response'] = "TLE";
                                $color = "color: #000ed2;";
                            }
                            else
                            {
                                $color = "color: #000000;";
                            }
                        ?>
                         <td style="<?= (isset($color) ? $color : "" ); ?>"><?= $problem['response']; ?></td>
                    <?php endforeach; ?>
                    <td><?= $this->Time->format(' h:i A' , $row['last_submittion_time']); ?></td>

            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

