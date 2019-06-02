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
    name: 'fio2',
    choices: {
      less: 'pao2',
      more: 'aapo2',
    }
  },
  {
    name: 'pao2',
    exclude: true,
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
    exclude: true,
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
    name: 'ph_choice',
    choices: {
      ph: 'ph',
      hco3: 'hco3',
    }
  },
  {
    name: 'ph',
    exclude: true,
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 7.15, value: 4},
        {key: 7.25, value: 3},
        {key: 7.33, value: 2},
        {key: 7.5, value: 0},
        {key: 7.6, value: 1},
        {key: 7.7, value: 3},
      ]
    }
  },
  {
    name: 'hco3',
    exclude: true,
    range: {
      include_equal: false,
      initial_value: 4,
      map: [
        {key: 15, value: 4},
        {key: 18, value: 3},
        {key: 22, value: 2},
        {key: 32, value: 0},
        {key: 41, value: 1},
        {key: 52, value: 3},
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
    if (item.range) {
      score = getScoreFromRange($("[name='" + item.name + "']").val(), item.range)
      $("[name='" + item.name + "_score']").val(score)
    }
  })

  input_list.forEach(function(item) {
    if (item.exclude) return;

    var score;
    if (item.choices) {
      const choice = $("#" + item.name + " input:radio:checked").val();
      if (!choice)
        return
      Object.keys(item.choices).forEach(function(key) {
        if (choice == key)
          score = $("[name='" + item.choices[key] + "_score']").val()
      })
    } else {
      score = $("[name='" + item.name + "_score']").val()
    }

    total_score += Number(score)
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

const displayOption = function() {
  input_list.forEach(function(item) {
    if (item.choices) {
      const choice = $("#" + item.name + " input:radio:checked").val();
      Object.keys(item.choices).forEach(function(key) {
        if (choice == key)
          $("." + item.choices[key]).show();
        else
          $("." + item.choices[key]).hide();
      })
    }
  })
  recalculateAllScore();
}

$(function() {
  input_list.forEach(function(item) {
    $("[name='" + item.name + "']").change(recalculateAllScore)
  })

  $("[name='glasgow_coma']").change(recalculateAllScore)

  input_list.forEach(function(item) {
    if (item.choices) {
      $("#" + item.name + " input:radio:checked").parent().addClass('active');
      $("#" + item.name + " input:radio").change(displayOption)
    }
  })

  displayOption()
  recalculateAllScore()
});