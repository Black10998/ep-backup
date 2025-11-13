<?php
// Get problems section fields
$problems_heading = ep_get_field( 'problems_heading', get_the_ID(), 'Typische Probleme – und wie wir sie zuverlässig lösen' );
$problems_intro = ep_get_field( 'problems_intro', get_the_ID(), 'Viele unserer Einsätze beginnen mit kleinen Alltagsproblemen, die schnell größer werden können. Als Fachbetrieb erkennen wir die Ursache, handeln schnell und sorgen dafür, dass das Problem nicht erneut auftritt. Hier sind fünf typische Fälle aus der Praxis – und was wir konkret tun:' );
$problems_list = ep_get_field( 'problems_list', get_the_ID() );

// Default problems if ACF not available
$default_problems = array(
    array(
        'title' => '✅ Steckdose defekt oder locker',
        'text' => 'Lose oder ausgebrannte Steckdosen sind nicht nur nervig, sondern können zur echten Gefahr werden. Wir prüfen die Verdrahtung, tauschen defekte Einsätze und stellen die sichere Funktion wieder her – schnell und fachgerecht.'
    ),
    array(
        'title' => '✅ Lichtschalter funktioniert nicht',
        'text' => 'Ob Wackelkontakt oder völliger Ausfall: Wir tauschen defekte Lichtschalter zügig aus und prüfen die Stromzufuhr. Auf Wunsch modernisieren wir auch direkt auf smarte Schaltertechnik.'
    ),
    array(
        'title' => '✅ Sicherung fällt ständig raus',
        'text' => 'Wiederholte Sicherungsausfälle sind ein Warnsignal. Wir messen die Leitungen durch, prüfen auf Kurzschlüsse oder Überlastung und beheben die Ursache nachhaltig – für einen sicheren Betrieb.'
    ),
    array(
        'title' => '✅ Stromausfall in Wohnung oder Haus',
        'text' => 'Plötzlicher Stromausfall? Wir lokalisieren die Fehlerquelle – ob im Sicherungskasten, FI-Schalter oder an einzelnen Stromkreisen – und sorgen für die schnelle Wiederherstellung der Versorgung.'
    ),
    array(
        'title' => '✅ Kurzschluss hinter der Wand',
        'text' => 'Ein verschmorter Geruch oder Lichtausfall kann auf einen gefährlichen Kurzschluss hindeuten. Wir lokalisieren die Stelle präzise mit modernen Messgeräten und tauschen nur, was nötig ist – sauber und mit minimalem Eingriff.'
    ),
    array(
        'title' => '✅ Alte Elektrik modernisieren',
        'text' => 'Veraltete Elektroinstallationen entsprechen oft nicht mehr den aktuellen Sicherheitsstandards. Wir bringen Ihre Anlage auf den neuesten Stand – von der Verkabelung bis zum Sicherungskasten.'
    ),
    array(
        'title' => '✅ FI-Schalter löst aus',
        'text' => 'Wenn der FI-Schalter häufig auslöst, liegt meist ein Fehler in der Installation vor. Wir finden die Ursache schnell und beheben sie dauerhaft.'
    ),
    array(
        'title' => '✅ Elektrogeräte funktionieren nicht',
        'text' => 'Wenn Elektrogeräte plötzlich nicht mehr funktionieren, kann das an der Stromversorgung liegen. Wir prüfen die Anschlüsse und stellen die Funktion wieder her.'
    )
);

// Use ACF problems if available, otherwise use defaults
$problems_to_display = array();
if ( ! empty( $problems_list ) && is_array( $problems_list ) ) {
    foreach ( $problems_list as $problem ) {
        if ( ! empty( $problem['problem_title'] ) ) {
            $problems_to_display[] = array(
                'title' => $problem['problem_title'],
                'text' => ! empty( $problem['problem_text'] ) ? $problem['problem_text'] : ''
            );
        }
    }
}

// If no ACF problems, use defaults
if ( empty( $problems_to_display ) ) {
    $problems_to_display = $default_problems;
}

// Split into two columns
$half = ceil( count( $problems_to_display ) / 2 );
$column1 = array_slice( $problems_to_display, 0, $half );
$column2 = array_slice( $problems_to_display, $half );
?>

<!-- Problems Section -->
<section class="problems-section">
    <div class="container">
        <h2><?php echo esc_html( $problems_heading ); ?></h2>
        
        <p><?php echo esc_html( $problems_intro ); ?></p>
        
        <div class="problems-grid">
            <div class="problem-item">
                <?php foreach ( $column1 as $problem ) : ?>
                <h3><?php echo esc_html( $problem['title'] ); ?></h3>
                <p><?php echo esc_html( $problem['text'] ); ?></p>
                <?php endforeach; ?>
            </div>
            
            <div class="problem-item">
                <?php foreach ( $column2 as $problem ) : ?>
                <h3><?php echo esc_html( $problem['title'] ); ?></h3>
                <p><?php echo esc_html( $problem['text'] ); ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
