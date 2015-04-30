<!-- File: /app/View/Posts/index.ctp -->

<h1>Posts DB</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
		<th>Body</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>

<!-- Here's where we loop through our $phones array, printing out phone info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
            ?>
        </td>
		<td><?php echo $post['Post']['body']; ?></td>
        
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
        <td>
            <?php echo $post['Post']['modified']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>