<div class="container">
<h1>A Fancy Table</h1>

<table id="customers" border="0">
  <tr>
    <th>titre</th>
    <th>proprietaire</th>
    <th>date début</th>
    <th>date fin</th>
    <?php 
    for( $i = 0 ; $i < count($historiques); $i++ ){
        if( $i > 50 )   break;
    
    ?>
        </tr>
            <td><?php echo $historiques[$i]['titre'];?></td>
            <td><?php echo $historiques[$i]['nom'];?></td>
            <td><?php echo $historiques[$i]['datedebut'];?></td>
            <?php 
            if( $historiques[$i]['datefin'] != null ){
            ?>
                <td><?php echo $historiques[$i]['datefin'];?></td>
            <?php
            } else{
                ?>
                <td> En possession </td>
                <?php
            }
            ?>
        <tr>
    <?php
    }
    ?>
</tr>
</table>


</div>