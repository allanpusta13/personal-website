<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts::app')]
#[Title('Alvin Allan Dan Pusta — Back End Developer & Full-Stack Engineer')]
class extends Component
{
    public $featuredSystems = [];
    public $techStack = [];
    public $experience = [];
    public $competencies = [
        'focusAreas' => [],
        'educationAndCertifications' => null,
    ];

    public function mount()
    {
         $data = config('portfolio');

    $rawSystems = $data['featuredSystems'] ?? [];

    usort($rawSystems, function ($a, $b) {
        $aPersonal = ($a['isPersonal'] ?? false) || (($a['badge'] ?? '') === 'Personal Project') ? 1 : 0;
        $bPersonal = ($b['isPersonal'] ?? false) || (($b['badge'] ?? '') === 'Personal Project') ? 1 : 0;
        return $bPersonal - $aPersonal;
    });

    $this->featuredSystems = $rawSystems;
    $this->techStack       = $data['techStack'] ?? [];
    $this->experience      = $data['experience'] ?? [];
    $this->competencies    = $data['competencies'] ?? [
        'focusAreas' => [],
        'educationAndCertifications' => null,
    ];
    }
};

?>

<div x-data="{ mobileNav: false, activeTab: 'systems', galleryModal: false, activeGallerySystem: null }">
    {{-- HEADER --}}
    <header class="sticky top-0 z-50 bg-bg/80 backdrop-blur-xl border-b border-border-subtle">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3">
            <a href="#"
                class="font-mono text-sm font-semibold text-ink tracking-tight flex items-center gap-2.5 hover:text-accent transition-colors">
                <span class="w-2 h-2 rounded-full bg-ok"></span>
                allanpusta<span class="text-mute">.dev</span>
            </a>
            <nav class="hidden sm:flex items-center gap-1 font-mono text-xs text-dim">
                <button
                    @click="activeTab = 'systems'; document.getElementById('tabs').scrollIntoView({behavior:'smooth'})"
                    class="px-3 py-1.5 rounded-md hover:text-accent hover:bg-accent-glow transition-all duration-200">Projects</button>
                <button @click="activeTab = 'tech'; document.getElementById('tabs').scrollIntoView({behavior:'smooth'})"
                    class="px-3 py-1.5 rounded-md hover:text-accent hover:bg-accent-glow transition-all duration-200">Tech
                    Stack</button>
                <button
                    @click="activeTab = 'experience'; document.getElementById('tabs').scrollIntoView({behavior:'smooth'})"
                    class="px-3 py-1.5 rounded-md hover:text-accent hover:bg-accent-glow transition-all duration-200">Experience</button>
                <button
                    @click="activeTab = 'solutions'; document.getElementById('tabs').scrollIntoView({behavior:'smooth'})"
                    class="px-3 py-1.5 rounded-md hover:text-accent hover:bg-accent-glow transition-all duration-200">Competencies</button>
            </nav>
            <div class="flex items-center gap-3">
                <button @click="mobileNav = !mobileNav" class="nav-hamburger" :aria-expanded="mobileNav"
                    aria-label="Toggle navigation">
                    <span></span><span></span><span></span>
                </button>
                <a href="#contact" class="btn-primary hidden sm:inline-flex text-xs">Get in Touch</a>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div x-show="mobileNav" x-transition:enter="transition-opacity duration-200"
            x-transition:leave="transition-opacity duration-200" @click="mobileNav = false"
            class="sm:hidden fixed inset-0 z-[100] bg-bg/80 backdrop-blur-sm" style="display:none"></div>
        <nav x-show="mobileNav" x-transition:enter="transition-transform duration-300"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition-transform duration-300" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="sm:hidden z-[101] bg-bg border-l border-border overflow-y-auto"
            style="display:none; position:fixed; top:0; right:0; bottom:0; width:min(300px,85vw); height:100vh;"
            aria-label="Mobile navigation">
            <div
                class="flex items-center justify-between px-5 py-4 border-b border-border font-mono text-xs text-mute uppercase tracking-widest">
                <span>Navigation</span>
                <button @click="mobileNav = false"
                    class="w-11 h-11 flex items-center justify-center border border-border rounded-md text-dim hover:border-accent hover:text-accent transition-colors"
                    aria-label="Close navigation">&times;</button>
            </div>
            <div class="py-3">
                <button
                    @click="activeTab = 'systems'; mobileNav = false; setTimeout(() => document.getElementById('tabs').scrollIntoView({behavior:'smooth'}), 300)"
                    class="flex items-center gap-3 w-full px-5 py-3.5 font-mono text-sm text-dim hover:text-accent hover:bg-accent-glow border-l-2 border-transparent hover:border-accent transition-all">Featured
                    Systems</button>
                <button
                    @click="activeTab = 'tech'; mobileNav = false; setTimeout(() => document.getElementById('tabs').scrollIntoView({behavior:'smooth'}), 300)"
                    class="flex items-center gap-3 w-full px-5 py-3.5 font-mono text-sm text-dim hover:text-accent hover:bg-accent-glow border-l-2 border-transparent hover:border-accent transition-all">Tech
                    Stack</button>
                <button
                    @click="activeTab = 'experience'; mobileNav = false; setTimeout(() => document.getElementById('tabs').scrollIntoView({behavior:'smooth'}), 300)"
                    class="flex items-center gap-3 w-full px-5 py-3.5 font-mono text-sm text-dim hover:text-accent hover:bg-accent-glow border-l-2 border-transparent hover:border-accent transition-all">Experience</button>
                <button
                    @click="activeTab = 'solutions'; mobileNav = false; setTimeout(() => document.getElementById('tabs').scrollIntoView({behavior:'smooth'}), 300)"
                    class="flex items-center gap-3 w-full px-5 py-3.5 font-mono text-sm text-dim hover:text-accent hover:bg-accent-glow border-l-2 border-transparent hover:border-accent transition-all">Competencies</button>
                <a href="#contact" @click="mobileNav = false"
                    class="flex items-center gap-3 w-full px-5 py-3.5 font-mono text-sm text-dim hover:text-accent hover:bg-accent-glow border-l-2 border-transparent hover:border-accent transition-all">Contact</a>
            </div>
        </nav>
    </header>

    <main class="max-w-6xl mx-auto px-6">
        {{-- HERO --}}
        <section class="pt-14 pb-10 md:pt-18 md:pb-14">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-5">
                    <span class="availability-dot"></span>
                    <span class="label-mono text-ok">Available for Back-End, Full-Stack &amp; AI Engineering</span>
                </div>
                <h1 class="heading-display mb-4">
                    Back End Developer &amp; Full-Stack Engineer<br class="hidden md:block"> specializing in <span
                        class="text-accent">PHP</span>, <span class="text-accent">Laravel</span> &amp; <span
                        class="text-accent">Claude AI</span>
                </h1>
                <p class="text-dim text-lg md:text-xl leading-relaxed max-w-2xl mb-6">
                    Experienced Information Technology Specialist with 9+ years shipping production systems &mdash;
                    enterprise APIs, multi-branch HRIS &amp; inventory platforms, legacy PHP5&rarr;PHP8 migrations, and
                    autonomous agent workflows with Claude Code subagents.
                </p>
                <div class="flex flex-wrap items-center gap-3 mb-8">
                    <a href="#contact" class="btn-primary">Get in Touch &rarr;</a>
                    <a href="https://www.linkedin.com/in/alvin-allan-dan-pusta-39b78a141" target="_blank" rel="noopener"
                        class="btn-ghost">LinkedIn &nearr;</a>
                    <a href="https://github.com/allanpusta13" target="_blank" rel="noopener"
                        class="btn-ghost">GitHub</a>
                </div>

                <div class="recruiter-bento">
                    <div class="recruiter-micro">
                        <div class="label-mono text-accent mb-2">Core Backend &amp; TALL</div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="arch-tag">PHP 8.x</span>
                            <span class="arch-tag">Laravel</span>
                            <span class="arch-tag">Livewire</span>
                            <span class="arch-tag">Filament</span>
                        </div>
                    </div>
                    <div class="recruiter-micro">
                        <div class="label-mono text-accent mb-2">Claude AI (LinkedIn Top Skills)</div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="arch-tag text-accent font-semibold">Claude Code Subagents</span>
                            <span class="arch-tag">Anthropic Claude</span>
                            <span class="arch-tag">Claude Skills</span>
                        </div>
                    </div>
                    <div class="recruiter-micro">
                        <div class="label-mono text-accent mb-2">Architecture &amp; Data</div>
                        <div class="flex flex-wrap gap-1.5">
                            <span class="arch-tag">REST APIs</span>
                            <span class="arch-tag">Multi-Branch Sync</span>
                            <span class="arch-tag">PHP5&rarr;PHP8 Migration</span>
                            <span class="arch-tag">MySQL &amp; PostgreSQL</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SEGMENTED TABS --}}
        <section id="tabs" class="pb-16 md:pb-20">
            <div class="tab-container" role="tablist" aria-label="Portfolio sections">
                <button class="tab-trigger" :class="{ 'active': activeTab === 'systems' }"
                    @click="activeTab = 'systems'" role="tab" :aria-selected="activeTab === 'systems'"
                    aria-controls="tab-systems" :tabindex="activeTab === 'systems' ? 0 : -1">&#x1F680; Featured
                    Systems</button>
                <button class="tab-trigger" :class="{ 'active': activeTab === 'tech' }" @click="activeTab = 'tech'"
                    role="tab" :aria-selected="activeTab === 'tech'" aria-controls="tab-tech"
                    :tabindex="activeTab === 'tech' ? 0 : -1">&#x1F6E0; Tech Stack</button>
                <button class="tab-trigger" :class="{ 'active': activeTab === 'experience' }"
                    @click="activeTab = 'experience'" role="tab" :aria-selected="activeTab === 'experience'"
                    aria-controls="tab-experience" :tabindex="activeTab === 'experience' ? 0 : -1">&#x1F4BC; Production
                    Experience</button>
                <button class="tab-trigger" :class="{ 'active': activeTab === 'solutions' }"
                    @click="activeTab = 'solutions'" role="tab" :aria-selected="activeTab === 'solutions'"
                    aria-controls="tab-solutions" :tabindex="activeTab === 'solutions' ? 0 : -1">&#x1F4D0; Competencies
                    &amp; Background</button>
            </div>

            {{-- TAB: Featured Systems --}}
            <div x-show="activeTab === 'systems'" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="tab-panel" role="tabpanel" id="tab-systems">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($featuredSystems as $system)
                    <div class="glass p-6 group flex flex-col justify-between" id="system-{{ $system['id'] }}">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="label-mono text-mute">{{ $system['period'] }}</span>
                                @if (!empty($system['badge']))
                                <span class="badge text-[0.6rem] {{ $system['badgeClass'] ?? 'badge-accent' }}">{{
                                    $system['badge'] }}</span>
                                @endif
                            </div>
                            <h3 class="heading-card mb-1 group-hover:text-accent transition-colors duration-200">{{
                                $system['title'] }}</h3>
                            <div class="text-accent font-mono text-xs mb-3 font-medium">{{ $system['companyOrType'] }}
                            </div>
                            <p class="text-dim text-sm leading-relaxed mb-4">{{ $system['description'] }}</p>
                        </div>
                        <div>
                            <div class="flex flex-wrap gap-1.5 pt-2 mb-3">
                                @foreach ($system['tags'] as $tag)
                                <span
                                    class="arch-tag {{ (!empty($system['accentTags']) && in_array($tag, $system['accentTags'])) ? 'text-accent' : '' }}">{{
                                    $tag }}</span>
                                @endforeach
                            </div>
                            @if (!empty($system['githubUrl']) || !empty($system['galleryUrl']) ||
                            !empty($system['screenshots']))
                            <div class="flex flex-wrap items-center gap-2 pt-3 border-t border-border-subtle">
                                @if (!empty($system['screenshots']))
                                <button
                                    @click="activeGallerySystem = {{ Js::from($system) }}; galleryModal = true; document.body.style.overflow = 'hidden'"
                                    type="button"
                                    class="btn-primary text-xs py-1.5 px-3 flex items-center gap-1.5 cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>View Screenshots</span>
                                </button>
                                @endif
                                @if (!empty($system['githubUrl']))
                                <a href="{{ $system['githubUrl'] }}" target="_blank" rel="noopener"
                                    class="badge hover:border-accent hover:text-accent flex items-center gap-1.5 text-xs py-1.5 px-2.5 transition-colors">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                                    </svg>
                                    <span>GitHub &nearr;</span>
                                </a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB: Tech Stack --}}
            <div x-show="activeTab === 'tech'" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="tab-panel" role="tabpanel" id="tab-tech" style="display:none">
                <div class="bento-grid">
                    @foreach ($techStack as $card)
                    @php
                    $cardClasses = ($card['isSubtle'] ?? false) ? 'glass-subtle p-6' : 'glass p-6';
                    if ($card['isWide'] ?? false) $cardClasses .= ' bento-wide';
                    if ($card['isFeatured'] ?? false) $cardClasses .= ' border-accent/30 bg-accent-glow/20';
                    @endphp
                    <div class="{{ $cardClasses }}" id="tech-{{ $card['id'] }}">
                        <div class="flex items-center justify-between {{ !empty($card['badge']) ? 'mb-3' : 'mb-4' }}">
                            <div class="label-mono {{ ($card['isSubtle'] ?? false) ? 'text-mute' : 'text-accent' }}">{{
                                $card['category'] }}</div>
                            @if (!empty($card['badge']))
                            <span class="badge badge-accent text-[0.6rem]">{{ $card['badge'] }}</span>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($card['skills'] as $skill)
                            <span class="badge {{ ($skill['accent'] ?? false) ? 'badge-accent' : '' }}">{{
                                $skill['name'] }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB: Experience --}}
            <div x-show="activeTab === 'experience'" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="tab-panel" role="tabpanel" id="tab-experience" style="display:none">
                <div class="timeline">
                    @foreach ($experience as $entry)
                    <div class="timeline-entry experience-entry glass p-6 mb-4 {{ ($entry['current'] ?? false) ? 'timeline-entry-active' : '' }}"
                        id="exp-{{ $entry['id'] }}">
                        <div class="timeline-dot"></div>
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            @if ($entry['current'] ?? false)
                            <span class="label-mono text-ok">Current</span>
                            @endif
                            <span class="label-mono text-mute">
                                {{ $entry['period'] }}
                                @if (!empty($entry['duration']))
                                &middot; {{ $entry['duration'] }}
                                @endif
                            </span>
                        </div>
                        <h3 class="heading-card mb-1">{{ $entry['role'] }}</h3>
                        <div class="text-accent font-mono text-xs mb-3">
                            {{ $entry['company'] }}
                            @if (!empty($entry['location']))
                            &middot; {{ $entry['location'] }}
                            @endif
                        </div>
                        <ul class="space-y-1.5">
                            @foreach ($entry['bullets'] as $bullet)
                            <li
                                class="text-dim text-sm pl-4 relative before:content-['→'] before:absolute before:left-0 before:text-accent before:font-mono before:text-xs">
                                {!! $bullet !!}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TAB: Competencies --}}
            <div x-show="activeTab === 'solutions'" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="tab-panel" role="tabpanel" id="tab-solutions" style="display:none">
                <div class="bento-grid">
                    @foreach ($competencies['focusAreas'] as $card)
                    <div class="glass p-6 {{ ($card['isWide'] ?? false) ? 'bento-wide' : '' }}"
                        id="comp-{{ $card['id'] }}">
                        <div class="label-mono text-accent mb-3">{{ $card['title'] }}</div>
                        <p class="text-dim text-sm leading-relaxed mb-4">{{ $card['description'] }}</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach ($card['tags'] as $tag)
                            <span class="arch-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    @if ($competencies['educationAndCertifications'])
                    <div class="glass p-6 bento-wide" id="comp-education-certifications">
                        <div class="label-mono text-accent mb-4">{{
                            $competencies['educationAndCertifications']['category'] }}</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="heading-card mb-1 text-ink">{{
                                    $competencies['educationAndCertifications']['education']['degree'] }}</div>
                                <div class="text-accent font-mono text-xs mb-2">
                                    {{ $competencies['educationAndCertifications']['education']['institution'] }}
                                    &middot; {{ $competencies['educationAndCertifications']['education']['period'] }}
                                </div>
                                <p class="text-mute text-sm leading-relaxed mb-3">{{
                                    $competencies['educationAndCertifications']['education']['description'] }}</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($competencies['educationAndCertifications']['education']['tags'] as $tag)
                                    <span class="arch-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="border-t md:border-t-0 md:border-l border-border-subtle pt-4 md:pt-0 md:pl-6">
                                <div class="heading-card mb-1 text-ink">{{
                                    $competencies['educationAndCertifications']['certifications']['title'] }}</div>
                                <div class="text-accent font-mono text-xs mb-2">{{
                                    $competencies['educationAndCertifications']['certifications']['subtitle'] }}</div>
                                <div class="space-y-2 mb-3">
                                    @foreach ($competencies['educationAndCertifications']['certifications']['certs'] as $cert)
                                    <div class="flex items-center gap-2 text-xs font-mono text-ink">
                                        <span class="text-ok font-bold">&#x2713;</span>
                                        <span>{{ $cert }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="text-xs text-mute mb-2">{{
                                    $competencies['educationAndCertifications']['certifications']['topSkillsLabel'] }}
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($competencies['educationAndCertifications']['certifications']['topSkills'] as $skill)
                                    <span
                                        class="arch-tag {{ ($skill['accent'] ?? false) ? 'text-accent font-medium' : '' }}">{{
                                        $skill['name'] }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <div class="section-divider"></div>

        {{-- CONTACT --}}
        <section id="contact" class="py-20 md:py-28">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <div class="label-mono text-accent mb-3">Let's Build Something</div>
                <h2 class="heading-display mb-4">Get in Touch</h2>
                <p class="text-dim text-base md:text-lg">
                    Open to freelance contracts, legacy PHP modernizations, and full-time senior engineering roles. Send
                    a message below to start the conversation.
                </p>
            </div>

            <livewire:contact-form />

            <div class="text-center">
                <div class="font-mono text-xs text-mute uppercase tracking-wider mb-4">Direct Channels</div>
                <div class="flex justify-center flex-wrap items-center gap-3 mb-6">
                    <a href="tel:+639676020089"
                        class="badge hover:border-accent hover:text-accent flex items-center gap-1.5 py-1.5 px-3">
                        <span>&#x1F4DE;</span>
                        <span>+63 967 602 0089</span>
                    </a>
                    <a href="mailto:allanpusta.13@gmail.com"
                        class="badge hover:border-accent hover:text-accent flex items-center gap-1.5 py-1.5 px-3">
                        <span>&#x2709;</span>
                        <span>allanpusta.13@gmail.com</span>
                    </a>
                    <a href="https://github.com/allanpusta13" target="_blank" rel="noopener"
                        class="badge hover:border-accent hover:text-accent flex items-center gap-1.5 py-1.5 px-3">
                        <span>GitHub &nearr;</span>
                    </a>
                    <a href="https://www.linkedin.com/in/alvin-allan-dan-pusta-39b78a141" target="_blank" rel="noopener"
                        class="badge hover:border-accent hover:text-accent flex items-center gap-1.5 py-1.5 px-3">
                        <span>LinkedIn &nearr;</span>
                    </a>
                </div>
                <span class="font-mono text-xs text-mute">📍 Blk 9 Lot 2 Doña Felisa Subd., Mercedes, Zamboanga City,
                    Philippines &middot; GMT+8 &middot; Remote Worldwide</span>
            </div>
        </section>
    </main>

    <footer class="border-t border-border-subtle py-8">
        <div
            class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-3 font-mono text-xs text-mute">
            <span>&copy; 2026 Alvin Allan Dan Pusta</span>
            <span class="text-border">Built with Tailwind CSS &amp; Alpine.js</span>
        </div>
    </footer>

    {{-- Screenshot Gallery Modal --}}
    <div x-show="galleryModal" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[300] flex items-center justify-center p-4 sm:p-6 bg-black/85 backdrop-blur-md"
        @keydown.escape.window="galleryModal = false; activeGallerySystem = null; document.body.style.overflow = ''"
        @click.self="galleryModal = false; activeGallerySystem = null; document.body.style.overflow = ''"
        style="display: none;" role="dialog" aria-modal="true" aria-labelledby="gallery-modal-title">
        <div
            class="glass w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden shadow-2xl border border-border rounded-xl">
            <div class="flex items-center justify-between p-5 border-b border-border-subtle bg-bg/95">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="label-mono text-accent">PROJECT_GALLERY</span>
                        <span class="badge badge-accent text-[0.6rem]">Personal Project</span>
                    </div>
                    <h3 id="gallery-modal-title" class="text-lg font-bold text-ink"
                        x-text="activeGallerySystem ? activeGallerySystem.title : 'Project Screenshots'"></h3>
                </div>
                <button @click="galleryModal = false; activeGallerySystem = null; document.body.style.overflow = ''"
                    type="button"
                    class="p-2 text-mute hover:text-ink transition-colors cursor-pointer rounded-md hover:bg-surface"
                    aria-label="Close modal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-6 overflow-y-auto space-y-6">
                <div class="text-sm text-dim leading-relaxed"
                    x-text="activeGallerySystem ? activeGallerySystem.description : ''"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <template
                        x-for="(shot, sIndex) in (activeGallerySystem && activeGallerySystem.screenshots ? activeGallerySystem.screenshots : [])"
                        :key="sIndex">
                        <div
                            class="glass-subtle p-4 rounded-lg border border-border-subtle flex flex-col justify-between">
                            <template x-if="shot.imageUrl">
                                <img :src="shot.imageUrl" :alt="shot.title"
                                    class="w-full h-48 object-cover rounded-md mb-3 border border-border-subtle">
                            </template>
                            <template x-if="!shot.imageUrl">
                                <div
                                    class="w-full h-44 bg-surface/60 border border-dashed border-border-subtle rounded-md flex flex-col items-center justify-center p-4 text-center mb-3">
                                    <svg class="w-8 h-8 text-accent/70 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <div class="font-mono text-xs font-semibold text-accent"
                                        x-text="shot.placeholder || 'Screenshot Ready'"></div>
                                    <span class="text-[0.7rem] text-mute mt-1">Image slot ready for your
                                        screenshots</span>
                                </div>
                            </template>
                            <div>
                                <div class="font-mono text-xs font-semibold text-ink mb-1" x-text="shot.title"></div>
                                <p class="text-xs text-mute leading-relaxed" x-text="shot.caption"></p>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-border-subtle">
                    <div class="text-xs font-mono text-mute">
                        <span>Repository: </span>
                        <a :href="activeGallerySystem && activeGallerySystem.githubUrl ? activeGallerySystem.githubUrl : 'https://github.com/allanpusta13'"
                            target="_blank" rel="noopener" class="text-accent hover:underline"
                            x-text="activeGallerySystem && activeGallerySystem.githubUrl ? activeGallerySystem.githubUrl : 'https://github.com/allanpusta13'"></a>
                    </div>
                    <div class="flex items-center gap-2">
                        <template x-if="activeGallerySystem && activeGallerySystem.githubUrl">
                            <a :href="activeGallerySystem.githubUrl" target="_blank" rel="noopener"
                                class="btn-primary text-xs py-1.5 px-4 flex items-center gap-1.5">
                                <span>Open GitHub &nearr;</span>
                            </a>
                        </template>
                        <button
                            @click="galleryModal = false; activeGallerySystem = null; document.body.style.overflow = ''"
                            type="button"
                            class="badge hover:border-accent hover:text-ink text-xs py-1.5 px-3 cursor-pointer">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>