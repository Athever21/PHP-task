<section class="form-wrapper">
    <div class="form-header">
        <h1>WYCEŃ PROJEKT<span>.</span></h1>
        <p>Zainteresowała Cię nasza oferta? Wypełnij krótki formularz, powiedz nam o swoich oczekiwaniach - przygotujemy ofertę dostosowaną do Twoich wymagań.</p>
    </div>

    <form id="contact-form" class="request-form" method="post" action="/form-submit">
        <div class="row-2">
            <label>
                <input class="form-text-input" type="text" name="name" placeholder="Imię i nazwisko" required>
            </label>
            <label>
                <input class="form-text-input" type="text" name="company" placeholder="Firma">
            </label>
        </div>
        <div class="row-2">
            <label>
                <input class="form-text-input" type="text" name="phone" placeholder="Numer telefonu" pattern="[0-9\s\-\+\(\)]{9,15}" required>
            </label>
            <label>
                <input class="form-text-input" type="email" name="email" placeholder="E-mail" required>
            </label>
        </div>

        <section class="section-block">
            <h2>Systemy</h2>
            <div class="grid-checkbox">
                <div class="checkbox-item">
                    <input type="checkbox" name="systems[]" value="b2b" id="systems_b2b">
                    <label for="systems_b2b">B2B</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="systems[]" value="b2c" id="systems_b2c">
                    <label for="systems_b2c">B2C</label>
                </div>
            </div>
        </section>

        <section class="section-block">
            <h2>Integracje</h2>
            <div class="grid-checkbox">
                <div class="checkbox-item">
                    <input type="checkbox" name="integrations[]" value="allegro" id="integrations_allegro">
                    <label for="integrations_allegro">Allegro</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="integrations[]" value="kurier" id="integrations_kurier">
                    <label for="integrations_kurier">Kurier</label>
                </div>
            </div>
        </section>

        <section class="section-block">
            <h2>Integracja z ERP</h2>
            <div class="grid-checkbox">
                <div class="checkbox-item">
                    <input type="checkbox" name="erp[]" value="comarch_xl" id="erp_comarch_xl">
                    <label for="erp_comarch_xl">Comarch XL</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="erp[]" value="comarch_optima" id="erp_comarch_optima">
                    <label for="erp_comarch_optima">Comarch Optima</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="erp[]" value="subiekt_gt" id="erp_subiekt_gt">
                    <label for="erp_subiekt_gt">Subiekt GT</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="erp[]" value="wf_mag" id="erp_wf_mag">
                    <label for="erp_wf_mag">WF-MAG</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="erp[]" value="other" id="erp_other">
                    <label for="erp_other">Inny</label>
                </div>
            </div>
        </section>

        <section class="section-block">
            <h2>Inne rozwiązania</h2>
            <div class="grid-checkbox">
                <div class="checkbox-item">
                    <input type="checkbox" name="extras[]" value="wms" id="extras_wms">
                    <label for="extras_wms">WMS</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="extras[]" value="data_migration" id="extras_data_migration">
                    <label for="extras_data_migration">Migracja danych</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="extras[]" value="international" id="extras_international">
                    <label for="extras_international">Sprzedaż międzynarodowa</label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" name="extras[]" value="omnichannel" id="extras_omnichannel">
                    <label for="extras_omnichannel">Omnichannel</label>
                </div>
                <div class="checkbox-item"><input type="checkbox" name="extras[]" value="multistore" id="extras_multistore"><label for="extras_multistore">Multistore</label></div>
                <div class="checkbox-item"><input type="checkbox" name="extras[]" value="mobile_app" id="extras_mobile_app"><label for="extras_mobile_app">Aplikacja mobilna dla handlowców</label></div>
            </div>
        </section>

        <div class="textarea-row">
            <label>Treść:</label>
            <textarea class="form-text-input" name="message" rows="6" placeholder="Wpisz tekst" required></textarea>
        </div>

        <div class="captcha-row">
            <div class="g-recaptcha" data-sitekey="<?= $_ENV['RECAPTCHA_SITE_KEY'] ?>" data-callback="captchaVerify"></div>
            <p id="captcha-error" class="field-error">To pole jest wymagane.</p>
        </div>

        <div class="consent">
            <input id="consent" type="checkbox" name="consent" required>
            <label for="consent">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum doloribus fugit tempora, unde quas, deserunt dolorum aperiam ut ea voluptatem aspernatur nesciunt dicta eligendi atque! Iste quo sunt, explicabo rem, reiciendis odit inventore eaque commodi necessitatibus labore, autem officiis fugit minima unde tempore tempora quas! Voluptatibus cupiditate dicta ratione culpa nobis dolore sequi, aliquid, quidem vero distinctio accusamus soluta! Repudiandae?
            </label>
        </div>
        <button type="submit" class="form-submit">Wyślij</button>
    </form>
</section>