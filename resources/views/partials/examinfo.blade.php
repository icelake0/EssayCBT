<blockquote>
  <h3 class="box-title">Exam Information</h3>
  <ul class="list-icons">
        <li><i class="fa fa-caret-right text-info"></i><strong>Date : </strong>{{$exam->date}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Time : </strong>{{$exam->time}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Duration : </strong>{{$exam->duration}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Questions : </strong>{{count($exam->getQuestions())}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Point : </strong>{{$exam->point}}</li>
        <li><i class="fa fa-caret-right text-info"></i><strong>Total Points : </strong>{{count($exam->getQuestions())*$exam->point}}</li>
  </ul>
</blockquote>