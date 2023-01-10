<div style="display: flex; justify-content:center" class="mt-5">

    <style>
    * {
  margin: 0;
  padding: 0;
}

body {
  background: #C2BEB2;
}

@font-face {
	font-family: 'VT323';
	src: url("/font/VT323-Regular.ttf") format("truetype")
}
.table {
  padding: 25px;
  width: 790px;
  height: 80px;
  background-color: #d4e5ff;
}
.table .monitor-wrapper {
  background: #050321;
  width: 770px;
  height: 60px;
  box-shadow: 0px 2px 2px 2px rgba(0, 0, 0, 0.3);
}
.table .monitor-wrapper .monitor {
  width: 100%;
  height: 70px;
  background-color: #344151;
  overflow: hidden;
  white-space: nowrap;
  box-shadow: inset 0px 5px 10px 2px rgba(0, 0, 0, 0.3);
}
.table .monitor-wrapper .monitor p {
  font-family: "VT323", monospace;
  font-size: 50px;
  position: relative;
  display: inline-block;
  animation: move {{10+(count($bets)*2)}}s infinite linear;
  color: #EBB55F;
}

@keyframes move {
  from {
    left: 800px;
  }
  to {
    left: -2000px;
  }
}
</style>

<div class="table center">
  <div class="monitor-wrapper center">
    <div class="monitor center">
      <p>Une partie va bientôt commencer, les paris sont ouverts :
        @foreach($bets as $bet)

          {{$bet->gamePlayers[0]->user->name}} {{$bet->gamePlayers[0]->bet_ratio}}x CONTRE {{$bet->gamePlayers[1]->user->name}} {{$bet->gamePlayers[1]->bet_ratio}}x  |
          @endforeach
      </p>
    </div>
  </div>
</div>


    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
</div>
