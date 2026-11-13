<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <section class="dashboard room-scene">
  <div class="window-scene">
    <i></i><i></i><span class="moon"></span><span class="star s1"></span>
  </div>
  <div class="dashboard-grid">
    <section class="notice-board">
      <div class="pin left"></div>
      <div class="pin right"></div>
      <p class="eyebrow">TODAY AT A GLANCE</p>
      <h2>The library is quietly bustling.</h2>
      <div class="stats-row">
        <div class="stat"><strong data-bind="totalBooks">32</strong><small>Total books</small></div>
        <div class="stat"><strong data-bind="totalMembers">6</strong><small>Members</small></div>
        <div class="stat"><strong data-bind="activeLoans">2</strong><small>On loan</small></div>
        <div class="stat">
          <strong data-bind="availableBooks">20</strong><small>Available</small>
        </div>
        <div class="stat"><strong data-bind="overdueLoans">2</strong><small>Overdue</small></div>
      </div>
    </section>
    <section class="journal">
      <div class="tape"></div>
      <div class="section-title">
        <div>
          <p class="eyebrow">KEEPER'S JOURNAL</p>
          <h2>Recent activity</h2>
        </div>
      </div>
      <div class="activity-list">
        <!-- LIVEWIRE: loop $recentActivities here -->
        <div class="activity">
          <span class="activity-icon">▤</span>
          <div>
            <strong>Maya Putri</strong>
            <p>borrowed <b>The Midnight Library</b></p>
          </div>
          <small>08 Jun</small>
        </div>
      </div>
    </section>
    <section class="wood-panel borrowing-summary">
      <div class="section-title">
        <div>
          <p class="eyebrow">WEEKLY CIRCULATION</p>
          <h2>Borrowing rhythm</h2>
        </div>
        <span class="trend">+12%</span>
      </div>
      <div class="bar-chart">
        <div><span style="height: 34%"></span><small>M</small></div>
        <div><span style="height: 65%"></span><small>T</small></div>
        <div><span style="height: 82%"></span><small>W</small></div>
        <div><span style="height: 55%"></span><small>T</small></div>
        <div><span style="height: 76%"></span><small>F</small></div>
      </div>
    </section>
  </div>
</section>

</body>
</html>