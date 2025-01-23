<x-layouts.guest>
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <main>
            <div>
                <span>Découvrez</span>
                <h1>Nos Solutions</h1>
                <hr>
                <p style="color:#999999">
                    Chez OCODAS Corp., nous innovons pour transformer la technologie, développer les infrastructures, et
                    former pour un avenir meilleur.
                </p>
                <a href="#">En savoir plus</a>
            </div>
            <div class="home-swiper swiper">
                <div class="swiper-wrapper">
                    @foreach ($slides as $slide)
                        <div class="swiper-slide"
                            style="background: linear-gradient(to top, #0f2027, #203a4300, #2c536400), url('{{ $slide->getMainImage() }}') no-repeat 50% 50%/cover;">
                            <div>
                                <h2>{{ $slide->title }}</h2>
                                <p>{{ $slide->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <img src="https://cdn.pixabay.com/photo/2018/07/14/11/32/network-3537400_960_720.png" alt=""
                class="bg">
            <img src="https://cdn.pixabay.com/photo/2018/07/14/11/32/network-3537400_960_720.png" alt=""
                class="bg2">
        </main>
    </section>

    <!-- End Hero -->

    <main id="main">

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container" data-aos="zoom-in">

                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/logo_uza.png" class="img-fluid"
                                alt=""></div>
                        <div class="swiper-slide"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/Logo_USB2.png" class="img-fluid"
                                alt="">
                        </div>
                        <div class="swiper-slide"></div>
                        <div class="swiper-slide"><img src="assets/img/clients/logo_istm2.png" class="img-fluid"
                                alt="">
                        </div>
                        <div class="swiper-slide"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Clients Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="row no-gutters">
                    <div class="content col-xl-5 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Pourquoi Nous Choisir !</h3>
                            <p>
                                Choisissez OCODAS pour des solutions informatiques fiables, innovantes et adaptées à
                                vos besoins. Faites confiance à
                                notre expertise pour propulser votre entreprise vers de nouveaux sommets.
                            </p>
                            <a href="#" class="about-btn"><span>About us</span> <i
                                    class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="col-xl-7 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <i class="bx bx-receipt"></i>
                                    <h4>Une equipe d'experts internes et externes</h4>
                                    <p>La différence, le professionnalisme, la rigueur, la transparence et le
                                        dévouement nous caractérisent</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <i class="bx bx-cube-alt"></i>
                                    <h4>Services Personnalisés</h4>
                                    <p>Nous savons que chaque entreprise a des besoins spécifiques. C'est pourquoi
                                        nous offrons des solutions sur mesure, adaptées à vos exigences
                                        particulières.</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <i class="bx bx-images"></i>
                                    <h4> Innovation et Technologie </h4>
                                    <p>OCODAS s'engage à rester à la pointe de la technologie. Nous investissons
                                        continuellement dans la recherche et le développement pour vous fournir des
                                        solutions innovantes et à jour</p>
                                </div>
                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                                    <i class="bx bx-shield"></i>
                                    <h4> Engagement envers la Qualité</h4>
                                    <p>La qualité est au cœur de tout ce que nous faisons. De la planification à
                                        l'exécution, nous nous assurons que chaque projet est réalisé selon les
                                        normes les plus élevées</p>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-emoji-smile"></i>
                            <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Clients Satisfant</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Projects</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="200" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Etudiants Formés</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg ">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Nos Services</h2>
                    <p>Chez OCODAS, nous offrons une gamme complète de produits et services
                        informatiques conçus pour répondre aux besoins variés de nos clients.
                        Voici un aperçu de ce que nous proposons :</p>
                </div>

                <div class="row">
                    <?php foreach ($services as $service): ?>
                    <div class="col-md-6 mt-4 mt-md-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="<?= $service['delay'] ?>">
                            <i class="<?= $service['icon'] ?>"></i>
                            <h4><a href="#"><?= $service['title'] ?></a></h4>
                            <p><?= $service['description'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- End Services Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio ttm-row pt-60 pb-140 ttm-bgcolor-grey">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Nos Réalisations</h2>
                    <p>Découvrez nos réalisations et voyez comment nous avons aidé diverses
                        entreprises à transformer leurs opérations grâce à des solutions informatiques
                        innovantes et personnalisées.</p>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div x-data="projectsFilter()" x-init="initializeCategories({{ json_encode($projects) }})" class="ttm-tabs">
                            <!-- Filtres dynamiques -->
                            <ul class="tabs text-right">
                                <template x-for="(category, index) in categories" :key="index">
                                    <li class="tab" :class="{ 'active': currentCategory === category }">
                                        <a href="#" @click.prevent="filterByCategory(category)"
                                            x-text="getCategoryLabel(category)" style="transition: all 0.3s ease"></a>
                                    </li>
                                </template>
                            </ul>

                            <!-- Grille des projets -->
                            <div class="content-tab pt-20">
                                <div class="content-inner active">
                                    <div class="row multi-columns-row ttm-boxes-spacing-10px">
                                        @foreach ($projects as $project)
                                            <div x-data="{ projectCategories: {{ json_encode($project->categories) }} }" x-show="shouldShowProject(projectCategories)"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 transform scale-95"
                                                x-transition:enter-end="opacity-100 transform scale-100"
                                                x-transition:leave="transition ease-in duration-200"
                                                x-transition:leave-start="opacity-100 transform scale-100"
                                                x-transition:leave-end="opacity-0 transform scale-95"
                                                class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-12">
                                                <x-project-card :project="$project" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Temoignages des partenaires et Clients</h2>
                    <p>Découvrez ce que nos partenaires et clients disent de leur expérience avec OCODAS.
                        Leur satisfaction et leurs succès témoignent de
                        notre engagement à fournir des solutions informatiques de qualité.</p>
                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/presento/assets/img/testimonials/justin_.heic" class="testimonial-img"
                                        alt="">
                                    <h3>Justin Fimbo</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                    <h4>UZASHOP POS</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Le partenariat entre UzaShop POS et OCODAS a permis de déployer un
                                        système POS innovant et fiable, transformant la gestion des ventes et
                                        améliorant l'efficacité opérationnelle de nombreuses entreprises.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="/presento/assets/img/testimonials/testimonials-2.jpg"
                                        class="testimonial-img" alt="">
                                    <h3>Justin Fimbo</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                    <h4>UZASHOP POS</h4>
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        Le partenariat entre UzaShop POS et OCODAS a permis de déployer un
                                        système POS innovant et fiable, transformant la gestion des ventes et
                                        améliorant l'efficacité opérationnelle de nombreuses entreprises.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Team Section ======= -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Nous sommes là pour répondre à toutes vos questions et vous aider à trouver les solutions
                        informatiques dont vous avez besoin.
                        N'hésitez pas à nous contacter par les moyens suivants :</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-6">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <i class="bx bx-map"></i>
                                    <h3>Notre Address</h3>
                                    <p>RDC/ITURI/BUNIA, Av.... No</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-envelope"></i>
                                    <h3>Nos Adresses Mail </h3>
                                    <p>info@ocodas.com<br>direction@ocodas.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <i class="bx bx-phone-call"></i>
                                    <h3>Appelez-nous au :</h3>
                                    <p>+243 975 152 592<br>+243 995 071 498</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="{{ route('contact.store') }}" method="post" class="contact-form"
                            id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col form-group">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" placeholder="Votre Nom" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder="Votre Adresse Mail" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    name="subject" id="subject" value="{{ old('subject') }}" placeholder="Sujet"
                                    required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5"
                                    placeholder="Message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Messages -->
                            <div class="my-3">
                                <div class="loading" style="display: none">Envoi en cours...</div>
                                @if (session('success'))
                                    <div class="sent-message">{{ session('success') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="error-message">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Envoyez Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->
    </main><!-- End #main -->
</x-layouts.guest>




<style>
    .contact-form .form-control {
        padding: 12px 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
    }

    .contact-form .form-control:focus {
        border-color: #be914f;
        box-shadow: 0 0 0 0.2rem rgba(190, 145, 79, 0.25);
    }

    .contact-form button[type="submit"] {
        background: #be914f;
        border: 0;
        padding: 10px 30px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
    }

    .contact-form button[type="submit"]:hover {
        background: #ab8347;
    }

    .contact-form .loading {
        background: #fff;
        text-align: center;
        padding: 15px;
        border-radius: 4px;
    }

    .contact-form .error-message {
        color: #fff;
        background: #ed3c0d;
        text-align: center;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .contact-form .sent-message {
        color: #fff;
        background: #18d26e;
        text-align: center;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875em;
        margin-top: -12px;
        margin-bottom: 10px;
    }

    .transition {
        transition-property: opacity, transform;
    }

    .duration-200 {
        transition-duration: 200ms;
    }

    .duration-300 {
        transition-duration: 300ms;
    }

    .ease-in {
        transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
    }

    .ease-out {
        transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }

    .transform {
        transform: translateZ(0);
    }

    .scale-95 {
        transform: scale(.95);
    }

    .scale-100 {
        transform: scale(1);
    }

    .opacity-0 {
        opacity: 0;
    }

    .opacity-100 {
        opacity: 1;
    }

    /* Tabs container */
    .ttm-tabs .tabs {
        display: flex;
        justify-content: center;
        /* Keeps the text-right alignment */
        gap: 1rem;
        margin-bottom: 2rem;
        padding: 0;
        list-style: none;
        flex-wrap: wrap;
    }

    /* Individual tab */
    .ttm-tabs .tab {
        margin: 0;
    }

    .ttm-tabs .tab a {
        display: inline-block;
        padding: 10px 25px;
        color: #666;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 5px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        transition: all 0.3s ease;
    }

    /* Hover state */
    .ttm-tabs .tab a:hover {
        background-color: #f8f9fa;
        border-color: #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Active state */
    .ttm-tabs .tab.active a {
        background-color: #be914f;
        color: #fff;
        border-color: #be914f;
    }

    /* Projects grid spacing */
    .ttm-boxes-spacing-10px {
        margin: -10px;
    }

    .ttm-boxes-spacing-10px .ttm-box-col-wrapper {
        padding: 10px;
    }

    /* Content tab spacing */
    .content-tab.pt-20 {
        padding-top: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .ttm-tabs .tabs {
            justify-content: center;
        }

        .ttm-tabs .tab a {
            padding: 8px 20px;
            font-size: 14px;
        }
    }

    /* Transitions for filtering */
    .transition {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    .transform {
        transform: translateZ(0);
    }

    .opacity-0 {
        opacity: 0;
    }

    .opacity-100 {
        opacity: 1;
    }

    .scale-95 {
        transform: scale(.95);
    }

    .scale-100 {
        transform: scale(1);
    }

    /* Animation for project cards */
    .ttm-box-col-wrapper {
        transition: transform 0.3s ease;
    }

    .ttm-box-col-wrapper:hover {
        transform: translateY(-5px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const loadingDiv = form.querySelector('.loading');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(e) {
            // Show loading state
            loadingDiv.style.display = 'block';
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Envoi en cours...';
        });
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('projectsFilter', () => ({
            currentCategory: 'all',
            categories: [],

            initializeCategories(projects) {
                // Get all unique categories from all projects' category arrays
                const allCategories = [...new Set(
                    projects.flatMap(project => project.categories)
                )].sort();

                // Add 'all' at the beginning
                this.categories = ['all', ...allCategories];
            },

            getCategoryLabel(category) {
                // Just return the category name as is, since it's already in proper format
                return category === 'all' ? 'Tous' : category;
            },

            filterByCategory(category) {
                this.currentCategory = category;
            },

            shouldShowProject(projectCategories) {
                if (this.currentCategory === 'all') return true;
                // Check if the project's categories array includes the current category
                return projectCategories.some(cat => cat === this.currentCategory);
            }
        }));
    });
</script>
