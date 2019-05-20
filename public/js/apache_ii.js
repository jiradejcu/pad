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
  input_list.forEach(function(item) {
    const score = getScoreFromRange($("[name='" + item.name + "']").val(), item.range)
    console.log(item.name + ' score: ' + score)
    total_score += score
  })
  $("#apache_ii_score").text(total_score)
}

$(function() {
  input_list.forEach(function(item) {
    $("[name='" + item.name + "']").change(recalculateAllScore)
  })
  recalculateAllScore()
});