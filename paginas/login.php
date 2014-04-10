<div id='login'>
    <form action="forms.php" method="post" data-validate="parsley">
        <label>Usuario:</label>
        <input type="text" class="usuario" name="usuario" data-required="true" data-rangelength="[4,15]"/>
        <label>Senha:</label>
        <input type="password" class="senha" name="senha"  data-required="true" data-rangelength="[6,15]"/>
        
        <div class="form-actions">
            <input type="hidden"  name="acao" value="login"/>
            <button type="submit">Login</button>
        </div>
    </form>
</div>