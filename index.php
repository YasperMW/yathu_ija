<?php
  require_once('db_connection.php'); // Include connection class
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Yathu Ija</title>
  <style>
    .carousel {
      position: relative;
      width: 100%;
      height: 500px; /* Adjust height as needed */
      overflow: hidden;
    }

    .carousel-inner {
      display: flex;
      transition: transform 0.5s ease;
    }

    .carousel-item {
      flex: 0 0 100%;
      height: 100%;
    }

    .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .carousel-control-prev,
    .carousel-control-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 50px;
      height: 50px;
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      text-align: center;
      line-height: 50px;
      text-decoration: none;
    }

    .carousel-control-prev {
      left: 0;
    }

    .carousel-control-next {
      right: 0;
    }
  </style>
</head>
<body>
  <?php include("nav.php");?>

  <header>
    <div id="carousel" class="carousel">
      <div class="carousel-inner">
      
        <div class="carousel-item active">
          <img src="images/YATHU_IJA BG2.png" alt="Slide 1">
        </div>

      
  </header>

  <!-- Page Content -->
  <div class="container">
    <h1 class="my-4">Welcome to Yathu Ija</h1>

    <!-- Marketing Icons Section -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Why Us</h4>
          <div class="card-body">
            <p class="card-text">
        Choose Yathu-Ija Bus Line for a seamless and enjoyable travel experience.
        With a steadfast commitment to safety, reliability, and comfort, 
        we ensure that every journey with us is a smooth ride from start to finish. 
        Our competitive fares, convenient booking options, and exceptional customer service 
        make planning and executing your travel plans hassle-free. Whether you're commuting to work,
        exploring new destinations, or embarking on a group adventure, 
        trust Yathu-Ija Bus Line to get you there safely, comfortably, and affordably.
        Join us on the road to convenience, reliability, and unparalleled service –
          choose Yathu-Ija Bus Line for your next journey.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Core Values</h4>
          <div class="card-body">
            <p class="card-text">Excellence, Trust and Openness, Integrity,
               Take Responsibility, Customer Orientation</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header">Discounts Offered</h4>
          <div class="card-body">
          <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Discount Name</th>
            <th>Discount Amount</th>
            <th>Eligibility</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Children</td>
            <td>50%</td>
            <td>Children below the age of 16</td>
          </tr>
          <tr>
            <td>Elderly</td>
            <td>50%</td>
            <td>Any person over the age of 70</td>
          </tr>
          <tr>
            <td>Student</td>
            <td>25%</td>
            <td>Any person studying up to tertiary level</td>
          </tr>
          <tr>
            <td>Inter-Regional</td>
            <td>10%</td>
            <td>Any person traveling between 2 regions</td>
          </tr>
          <tr>
            <td rowspan="4">Kabwerebwere</td>
            <td rowspan="4">100%</td>
            <td>Any person traveling with the bus line for the 5th time in a month.</td>
          </tr>
          <tr>
            <td>*Not applicable to students, children, and the elderly.</td>
          </tr>
          <tr>
            <td>*All 5 trips must be inter-regional trips.</td>
          </tr>
          <tr>
            <td>*After the 5th trip (free), the discount counter is reset.</td>
          </tr>
        </tbody>
      </table>
    </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <hr>
    <!-- Portfolio Section -->
    <h2 class="center">Most Hired Vehicles</h2>
    <!-- Portfolio Section -->
    <hr>
    <div class="row">
      
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="images/hiredbus3.png" alt=""></a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="#"><img class="card-img-top" src="images/hiredbus2.png" alt=""></a>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <hr>
    <h1 class="my-4">User feedbacks</h1>
    <div class="row">
      <?php
        $sql = "SELECT * FROM tms_feedback WHERE f_status = 'Published' ORDER BY RAND() LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_object()) {
      ?>
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header"><?php echo $row->f_uname; ?></h4>
          <div class="card-body">
            <p class="card-text"><?php echo $row->f_content; ?></p>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <!-- /.container -->

  <script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        if (i === index) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
      showSlide(currentIndex);
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % totalSlides;
      showSlide(currentIndex);
    }
  </script>

  <!-- Footer -->
  <?php include("footer.php"); ?>
  <!--.Footer-->
</body>
</html>
