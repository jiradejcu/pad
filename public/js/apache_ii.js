const input_list = [
  {
    name: 'temperature',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 30, value: 4},
        {key: 32, value: 3},
        {key: 34, value: 2},
        {key: 36, value: 1},
        {key: 38.5, value: 0},
        {key: 39, value: 1},
        {key: 41, value: 3},
      ]
    }
  },
  {
    name: 'mean_arterial_pressure',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 50, value: 4},
        {key: 70, value: 2},
        {key: 110, value: 0},
        {key: 130, value: 2},
        {key: 160, value: 3},
      ]
    }
  },
  {
    name: 'heart_rate',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 40, value: 4},
        {key: 55, value: 3},
        {key: 70, value: 2},
        {key: 110, value: 0},
        {key: 140, value: 2},
        {key: 180, value: 3},
      ]
    }
  },
  {
    name: 'respiratory_rate',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 6, value: 4},
        {key: 10, value: 2},
        {key: 12, value: 1},
        {key: 25, value: 0},
        {key: 35, value: 1},
        {key: 50, value: 3},
      ]
    }
  },
  {
    name: 'pao2',
    range: {
      include_equal: false,
      initial_value: 0,
      map: [
        {key: 55, value: 4},
        {key: 61, value: 3},
        {key: 71, value: 1},
      ]
    }
  },
  {
    name: 'aapo2',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 200, value: 0},
        {key: 350, value: 2},
        {key: 500, value: 3},
      ]
    }
  },
  {
    name: 'serum_na',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 111, value: 4},
        {key: 120, value: 3},
        {key: 130, value: 2},
        {key: 150, value: 0},
        {key: 155, value: 1},
        {key: 160, value: 2},
        {key: 180, value: 3},
      ]
    }
  },
  {
    name: 'serum_k',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 2.5, value: 4},
        {key: 3, value: 2},
        {key: 3.5, value: 1},
        {key: 5.5, value: 0},
        {key: 6, value: 1},
        {key: 7, value: 3},
      ]
    }
  },
  {
    name: 'creatinine',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 0.6, value: 2},
        {key: 1.5, value: 0},
        {key: 2, value: 2},
        {key: 3.5, value: 3},
      ]
    }
  },
  {
    name: 'hematocrit',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 20, value: 4},
        {key: 30, value: 2},
        {key: 46, value: 0},
        {key: 50, value: 1},
        {key: 60, value: 2},
      ]
    }
  },
  {
    name: 'wbc',
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 1, value: 4},
        {key: 3, value: 2},
        {key: 15, value: 0},
        {key: 20, value: 1},
        {key: 40, value: 2},
      ]
    }
  },
  {
    name: 'age',
    range: {
      include_equal: false,
      initial_value: 6,
      map: [
        {key: 45, value: 0},
        {key: 55, value: 2},
        {key: 65, value: 3},
        {key: 75, value: 5},
      ]
    }
  }
]

const getScoreFromRange = function(input, range) {
  if (input == "")
    return NaN
  input = Number(input)
  var result = range.initial_value;
  range.map.some(function(item) {
    if ((range.include_equal && input <= item.key) || (!range.include_equal && input < item.key)) {
      result = item.value
      return true
    }
  })
  return result
}

const recalculateAllScore = function() {
  var total_score = 0;
  var score;
  input_list.forEach(function(item) {
    score = getScoreFromRange($("[name='" + item.name + "']").val(), item.range)
    $("[name='" + item.name + "_score']").val(score)
    if (["pao2", "aapo2"].indexOf(item.name) >= 0) {
      const choice = $("#fio2 input:radio:checked").val();
      if (!choice)
        return;
      if (choice == 'less' && item.name != 'pao2')
        return;
      if (choice == 'more' && item.name != 'aapo2')
        return;
    }
    total_score += score
  })

  if ($("[name='glasgow_coma']").val() != "") {
    score = 15 - $("[name='glasgow_coma']").val()
  } else {
    score = NaN
  }
  $("[name='glasgow_coma_score']").val(score)
  total_score += score

  $("[name='apache_ii_score']").val(total_score)
}

$("#fio2 input:radio:checked").parent().addClass('active');

const displayOption = function() {
  const choice = $("#fio2 input:radio:checked").val();

  ["pao2", "aapo2"].forEach(function(item) {
    if (
      (choice == 'less' && item == 'pao2')
      || (choice == 'more' && item == 'aapo2')
    ) {
      $("." + item).show();
    } else
      $("." + item).hide();
  })
  recalculateAllScore();
}

$(function() {
  input_list.forEach(function(item) {
    $("[name='" + item.name + "']").change(recalculateAllScore)
  })

  $("[name='glasgow_coma']").change(recalculateAllScore)

  $("#fio2 input:radio").change(displayOption)

  displayOption()
  recalculateAllScore()
});