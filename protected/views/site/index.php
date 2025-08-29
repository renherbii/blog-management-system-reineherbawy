<h1>Welcome to the Blog Management System</h1>

<p>
    This is a role-based blog platform where:
    <ul>
        <li><strong>Admins</strong> can create, update, and delete posts.</li>
        <li><strong>Editors</strong> can create and update their own posts.</li>
        <li><strong>Users</strong> can read posts and comment.</li>
    </ul>
</p>

<p>
    Click the button below to go to the full list of posts.
</p>

<p>
    <?php echo CHtml::link('View All Posts', array('post/index'), array(
        'class'=>'btn btn-primary',
        'style'=>'padding: 10px 20px; background-color: #337ab7; color: white; text-decoration: none; border-radius: 5px;'
    )); ?>
</p>
