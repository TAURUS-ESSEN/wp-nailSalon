    <section data-reveal  class="m-auto flex flex-col md:flex-row items-center justify-center gap-4 bg-white pb-15">
    <?php
        $pid  = get_queried_object_id();
        $hero = get_field('hero', $pid);
        $cta_text = $hero['call_to_action_primary'] ?? null;
        $cta_url  = $hero['call_to_action_primary_url'] ?? null;
    ?>
    <?php if ($cta_text && $cta_url): ?>
    <h2 class="text-xl text-[#6B5B5B]">Bereit für schöne Nägel?</h2>
    <button
        type="button"
        data-modal-open="booking"
        class="cta-native">
        Termin buchen
    </button>
    <?php endif; ?>
    </section>