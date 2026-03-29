<section class="py-4 shadow-sm" style="background-color: var(--ilerna-light); border-bottom: 2px solid var(--ilerna-gold);">
    <div class="container">
        <form action="index.php" method="GET" class="row g-2 align-items-end">

            <div class="col-md-2">
                <label class="form-label small fw-bold text-uppercase text-secondary">¿Dónde buscas?</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt text-ilerna"></i></span>
                    <input type="text" name="ciudad" class="form-control border-start-0"
                        placeholder="Ej: Madrid, Sevilla..."
                        value="<?php echo $_GET['ciudad'] ?? ''; ?>">
                </div>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-bold text-uppercase text-secondary">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="">Cualquiera</option>
                    <option value="casa" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'casa') ? 'selected' : ''; ?>>Casa</option>
                    <option value="piso" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'piso') ? 'selected' : ''; ?>>Piso</option>
                    <option value="terreno" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'terreno') ? 'selected' : ''; ?>>Terreno</option>
                    <option value="chalet" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'chalet') ? 'selected' : ''; ?>>Chalet</option>
                    <option value="local" <?php echo (isset($_GET['tipo']) && $_GET['tipo'] == 'local') ? 'selected' : ''; ?>>Local</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-bold text-uppercase text-secondary">Habitaciones</label>
                <select name="habs" class="form-select">
                    <option value="">Mínimo</option>
                    <option value="1" <?php echo (isset($_GET['habs']) && $_GET['habs'] == '1') ? 'selected' : ''; ?>>1+</option>
                    <option value="2" <?php echo (isset($_GET['habs']) && $_GET['habs'] == '2') ? 'selected' : ''; ?>>2+</option>
                    <option value="3" <?php echo (isset($_GET['habs']) && $_GET['habs'] == '3') ? 'selected' : ''; ?>>3+</option>
                    <option value="4" <?php echo (isset($_GET['habs']) && $_GET['habs'] == '4') ? 'selected' : ''; ?>>4+</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-bold text-uppercase text-secondary">Baños</label>
                <select name="bano" class="form-select">
                    <option value="">Mínimo</option>
                    <option value="1" <?php echo (isset($_GET['bano']) && $_GET['bano'] == '1') ? 'selected' : ''; ?>>1+</option>
                    <option value="2" <?php echo (isset($_GET['bano']) && $_GET['bano'] == '2') ? 'selected' : ''; ?>>2+</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label small fw-bold text-uppercase text-secondary">Ordenar por</label>
                <select name="orden" class="form-select">
                    <option value="reciente" <?php echo (isset($_GET['orden']) && $_GET['orden'] == 'reciente') ? 'selected' : ''; ?>>Más recientes</option>
                    <option value="barato" <?php echo (isset($_GET['orden']) && $_GET['orden'] == 'barato') ? 'selected' : ''; ?>>Precio: más bajo</option>
                    <option value="caro" <?php echo (isset($_GET['orden']) && $_GET['orden'] == 'caro') ? 'selected' : ''; ?>>Precio: más alto</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-ilerna-pub w-100 py-2 fw-bold text-uppercase">
                    <i class="bi bi-search me-2"></i> Buscar
                </button>
            </div>
        </form>
    </div>
</section>