<?php

function getNextCode($lastCode) {
    // Parse the last code to extract the alphabet and number parts
    preg_match('/([A-Z]*)(\d+)/', $lastCode, $matches);
    $alphabet = $matches[1];
    $number = intval($matches[2]);
  
    // Check if we need to increment the alphabet
    if ($number === 9999) {
      $len = strlen($alphabet);
      if ($len === 0) {
        $alphabet = 'A';
      } elseif ($len === 1) {
        if ($alphabet === 'Z') {
          $alphabet = 'AA';
          $number = 0;
        } else {
          $alphabet++;
        }
      } elseif ($len === 2) {
        if ($alphabet === 'ZZ') {
          $alphabet = 'AAA';
          $number = 0;
        } else {
          $lastChar = substr($alphabet, -1);
          if ($lastChar === 'Z') {
            $prefix = substr($alphabet, 0, -1);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $alphabet = substr_replace($alphabet, ++$lastChar, -1);
          }
        }
      } elseif ($len === 3) {
        if ($alphabet === 'ZZZ') {
          $alphabet = 'AAAA';
          $number = 0;
        } else {
          $lastTwoChars = substr($alphabet, -2);
          if ($lastTwoChars === 'ZZ') {
            $prefix = substr($alphabet, 0, -2);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $lastChar = substr($alphabet, -1);
            if ($lastChar === 'Z') {
              $prefix = substr($alphabet, 0, -1);
              $alphabet = getNextCode($prefix);
              $number = 0;
            } else {
              $alphabet = substr_replace($alphabet, ++$lastChar, -1);
            }
          }
        }
      } elseif ($len === 4) {
        if ($alphabet === 'ZZZZ') {
          $alphabet = 'AAAAA';
          $number = 0;
        } else {
          $lastThreeChars = substr($alphabet, -3);
          if ($lastThreeChars === 'ZZZ') {
            $prefix = substr($alphabet, 0, -3);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $lastTwoChars = substr($alphabet, -2);
            if ($lastTwoChars === 'ZZ') {
              $prefix = substr($alphabet, 0, -2);
              $alphabet = getNextCode($prefix);
              $number = 0;
            } else {
              $lastChar = substr($alphabet, -1);
              if ($lastChar === 'Z') {
                $prefix = substr($alphabet, 0, -1);
                $alphabet = getNextCode($prefix);
                $number = 0;
              } else {
                $alphabet = substr_replace($alphabet, ++$lastChar, -1);
              }
            }
          }
        }
      } 
    } else {
      $number++;
    }
  
    // Combine the alphabet and number parts to form the next code
    $nextCode = $alphabet . sprintf('%04d', $number);
    return $nextCode;
  }

/*
function getNextCode($lastCode) {
    // Parse the last code to extract the alphabet and number parts
    preg_match('/([A-Z]*)(\d+)/', $lastCode, $matches);
    $alphabet = $matches[1];
    $number = intval($matches[2]);
  
    // Check if we need to increment the alphabet
    if ($number === 9999) {
      $len = strlen($alphabet);
      if ($len === 0) {
        $alphabet = 'A';
      } elseif ($len === 1) {
        if ($alphabet === 'Z') {
          $alphabet = 'AA';
          $number = 0;
        } else {
          $alphabet++;
        }
      } elseif ($len === 2) {
        if ($alphabet === 'ZZ') {
          $alphabet = 'AAA';
          $number = 0;
        } else {
          $lastChar = substr($alphabet, -1);
          if ($lastChar === 'Z') {
            $prefix = substr($alphabet, 0, -1);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $alphabet = substr_replace($alphabet, ++$lastChar, -1);
          }
        }
      } elseif ($len === 3) {
        if ($alphabet === 'ZZZ') {
          $alphabet = 'AAAA';
          $number = 0;
        } else {
          $lastTwoChars = substr($alphabet, -2);
          if ($lastTwoChars === 'ZZ') {
            $prefix = substr($alphabet, 0, -2);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $lastChar = substr($alphabet, -1);
            if ($lastChar === 'Z') {
              $prefix = substr($alphabet, 0, -1);
              $alphabet = getNextCode($prefix);
              $number = 0;
            } else {
              $alphabet = substr_replace($alphabet, ++$lastChar, -1);
            }
          }
        }
      } elseif ($len === 4) {
        if ($alphabet === 'ZZZZ') {
          $alphabet = 'AAAAA';
          $number = 0;
        } else {
          $lastThreeChars = substr($alphabet, -3);
          if ($lastThreeChars === 'ZZZ') {
            $prefix = substr($alphabet, 0, -3);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $lastTwoChars = substr($alphabet, -2);
            if ($lastTwoChars === 'ZZ') {
              $prefix = substr($alphabet, 0, -2);
              $alphabet = getNextCode($prefix);
              $number = 0;
            } else {
              $lastChar = substr($alphabet, -1);
              if ($lastChar === 'Z') {
                $prefix = substr($alphabet, 0, -1);
                $alphabet = getNextCode($prefix);
                $number = 0;
              } else {
                $alphabet = substr_replace($alphabet, ++$lastChar, -1);
              }
            }
          }
        }
      } 
    } else {
      $number++;
    }
  
    // Combine the alphabet and number parts to form the next code
    $nextCode = $alphabet . sprintf('%04d', $number);
    return $nextCode;
  }
  

/*
function getNextCode($lastCode) {
    // Parse the last code to extract the alphabet and number parts
    preg_match('/([A-Z]*)(\d+)/', $lastCode, $matches);
    $alphabet = $matches[1];
    $number = intval($matches[2]);
  
    // Check if we need to increment the alphabet
    if ($number === 9999) {
      $len = strlen($alphabet);
      if ($len === 0) {
        $alphabet = 'A';
      } elseif ($len === 1) {
        if ($alphabet === 'Z') {
          $alphabet = 'AA';
          $number = 0;
        } else {
          $alphabet++;
        }
      } elseif ($len === 2) {
        if ($alphabet === 'ZZ') {
          $alphabet = 'AAA';
          $number = 0;
        } else {
          $lastChar = substr($alphabet, -1);
          if ($lastChar === 'Z') {
            $prefix = substr($alphabet, 0, -1);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $alphabet = substr_replace($alphabet, ++$lastChar, -1);
          }
        }
      } elseif ($len === 3) {
        if ($alphabet === 'ZZZ') {
          $alphabet = 'AAAA';
          $number = 0;
        } else {
          $lastTwoChars = substr($alphabet, -2);
          if ($lastTwoChars === 'ZZ') {
            $prefix = substr($alphabet, 0, -2);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $lastChar = substr($alphabet, -1);
            if ($lastChar === 'Z') {
              $prefix = substr($alphabet, 0, -1);
              $alphabet = getNextCode($prefix);
              $number = 0;
            } else {
              $alphabet = substr_replace($alphabet, ++$lastChar, -1);
            }
          }
        }
      } elseif ($len === 4) {
        if ($alphabet === 'ZZZZ') {
          $alphabet = 'AAAAA';
          $number = 0;
        } else {
          $lastThreeChars = substr($alphabet, -3);
          if ($lastThreeChars === 'ZZZ') {
            $prefix = substr($alphabet, 0, -3);
            $alphabet = getNextCode($prefix);
            $number = 0;
          } else {
            $lastTwoChars = substr($alphabet, -2);
            if ($lastTwoChars === 'ZZ') {
              $prefix = substr($alphabet, 0, -2);
              $alphabet = getNextCode($prefix);
              $number = 0;
            } else {
              $lastChar = substr($alphabet, -1);
              if ($lastChar === 'Z') {
                $prefix = substr($alphabet, 0, -1);
                $alphabet = getNextCode($prefix);
                $number = 0;
              } else {
                $alphabet = substr_replace($alphabet, ++$lastChar, -1);
              }
            }
          }
        }
      } 
    } else {
      $number++;
    }
  
    // Combine the alphabet and number parts to form the next code
    $nextCode = $alphabet . sprintf('%04d', $number);
    return $nextCode;
  }
  

function getNextCode($lastCode) {
    $letters = range('A', 'Z');
    $maxCode = 'ZZZZZ';
    if ($lastCode === $maxCode) {
        return false; // Non ci sono altri codici disponibili
    }
    $codeArr = str_split($lastCode);
    $lettersCount = count($letters);

    // Incrementa l'ultima cifra finché è 9
    while ($codeArr[count($codeArr) - 1] === '9') {
        $codeArr[count($codeArr) - 1] = '0';

        // Se l'ultima cifra è 0, incrementa la cifra precedente
        if ($codeArr[count($codeArr) - 2] !== 'Z') {
            $codeArr[count($codeArr) - 2] = $letters[array_search($codeArr[count($codeArr) - 2], $letters) + 1];
            break;
        } else {
            // Rimetti la cifra precedente a 'A' e continua il ciclo
            $codeArr[count($codeArr) - 2] = 'A';
        }
    }

    // Incrementa la prima lettera finché non è Z
    if ($codeArr[0] !== 'Z') {
        $codeArr[0] = $letters[array_search($codeArr[0], $letters) + 1];
    } else {
        // Rimetti la prima lettera ad A e rimuovi l'ultima cifra
        $codeArr[0] = 'A';
        array_pop($codeArr);
    }

    return implode('', $codeArr);
}



function getNextCode($lastCode) {
    // Parse the last code to extract the alphabet and number parts
    preg_match('/([A-Z]*)(\d+)/', $lastCode, $matches);
    $alphabet = $matches[1];
    $number = intval($matches[2]);
  
    // Check if we need to increment the alphabet
    if ($number === 9999) {
      $len = strlen($alphabet);
      if ($len === 0) {
        $alphabet = 'A';
      } elseif ($len === 1) {
        if ($alphabet === 'Z') {
          $alphabet = 'AA';
        } else {
          $alphabet++;
        }
      } elseif ($len === 2) {
        if ($alphabet === 'ZZ') {
          $alphabet = 'AAA';
        } else {
          $lastChar = substr($alphabet, -1);
          if ($lastChar === 'Z') {
            $prefix = substr($alphabet, 0, -1);
            $alphabet = getNextCode($prefix) . 'A';
          } else {
            $alphabet = substr_replace($alphabet, ++$lastChar, -1);
          }
        }
      } elseif ($len === 3) {
        if ($alphabet === 'ZZZ') {
          $alphabet = 'AAAA';
        } else {
          $lastTwoChars = substr($alphabet, -2);
          if ($lastTwoChars === 'ZZ') {
            $prefix = substr($alphabet, 0, -2);
            $alphabet = getNextCode($prefix) . 'AA';
          } else {
            $lastChar = substr($alphabet, -1);
            if ($lastChar === 'Z') {
              $prefix = substr($alphabet, 0, -1);
              $alphabet = getNextCode($prefix) . 'A';
            } else {
              $alphabet = substr_replace($alphabet, ++$lastChar, -1);
            }
          }
        }
      } elseif ($len === 4) {
        if ($alphabet === 'ZZZZ') {
          $alphabet = 'AAAAA';
        } else {
          $lastThreeChars = substr($alphabet, -3);
          if ($lastThreeChars === 'ZZZ') {
            $prefix = substr($alphabet, 0, -3);
            $alphabet = getNextCode($prefix) . 'AAA';
          } else {
            $lastTwoChars = substr($alphabet, -2);
            if ($lastTwoChars === 'ZZ') {
              $prefix = substr($alphabet, 0, -2);
              $alphabet = getNextCode($prefix) . 'AA';
            } else {
              $lastChar = substr($alphabet, -1);
              if ($lastChar === 'Z') {
                $prefix = substr($alphabet, 0, -1);
                $alphabet = getNextCode($prefix) . 'A';
              } else {
                $alphabet = substr_replace($alphabet, ++$lastChar, -1);
              }
            }
          }
        }
      }
      $number = 0;
    } else {
      $number++;
    }
  
    // Combine the alphabet and number parts to form the next code
    $nextCode = $alphabet . sprintf('%04d', $number);
    return $nextCode;
  }
  

function getNextCode($lastCode) {
    $alphabet = range('A', 'Z');
    $lastAlphabetIndex = -1;
    $codeArr = str_split($lastCode);
    
    // Find the last alphabet index in the code
    for($i = 0; $i < count($codeArr); $i++) {
      if(in_array($codeArr[$i], $alphabet)) {
        $lastAlphabetIndex = $i;
      } else {
        break;
      }
    }
    
    // If the last code is a numeric only code
    if($lastAlphabetIndex === -1) {
      $newNumericCode = str_pad((string)((int)$lastCode + 1), 4, '0', STR_PAD_LEFT);
      return $codeArr[0] . $newNumericCode;
    }
    
    $numericCode = '';
    $numericCodeIndex = $lastAlphabetIndex + 1;
    
    // Get the numeric code from the last code
    for($i = $numericCodeIndex; $i < count($codeArr); $i++) {
      if(is_numeric($codeArr[$i])) {
        $numericCode .= $codeArr[$i];
      } else {
        break;
      }
    }
    
    $newAlphabetIndex = $lastAlphabetIndex;
    
    // Increment the last alphabet index if the numeric code has reached 9999
    if($numericCode === '9999') {
      $newAlphabetIndex++;
      $numericCode = '0000';
    }
    
    // Increment the last alphabet code
    if($newAlphabetIndex >= 0) {
      $newAlphabet = $codeArr[$newAlphabetIndex];
      $newAlphabetIndex++;
      if($newAlphabet === 'Z') {
        $newAlphabet = 'A';
      } else {
        $newAlphabet = $alphabet[array_search($newAlphabet, $alphabet) + 1];
      }
      $codeArr[$newAlphabetIndex - 1] = $newAlphabet;
    }
    
    // Create the new code
    $newNumericCode = str_pad((string)((int)$numericCode + 1), 4, '0', STR_PAD_LEFT);
    $codeArr = array_slice($codeArr, 0, $numericCodeIndex);
    return implode('', $codeArr) . $newNumericCode;
  }


function getNextCode($lastCode) {
    $letters = range('A', 'Z');
    $digits = range(0, 9);
    $code = str_split($lastCode);
    $index = count($code) - 1;
  
    while ($index >= 0) {
      $char = $code[$index];
  
      if (in_array($char, $letters)) {
        $letterIndex = array_search($char, $letters);
        $nextIndex = $letterIndex + 1;
        $code[$index] = $letters[$nextIndex % count($letters)];
        if ($nextIndex < count($letters)) {
          break;
        }
      } else if (in_array($char, $digits)) {
        if ($char == 9) {
          $code[$index] = 0;
          $index--;
        } else {
          $code[$index]++;
          break;
        }
      } else {
        throw new Exception('Invalid code format');
      }
    }
  
    return implode('', $code);
  }
  

function generateCode($lastCode) {
    $alphabet = range('A', 'Z');
    $lastChars = str_split($lastCode);
    $alphaIndex = array_search($lastChars[0], $alphabet);
    $numericPart = array_slice($lastChars, -4);
    $increment = 1;
    $codeLength = count($lastChars);
    
    // Check if last code is at maximum value
    if (array_sum(array_map('intval', $numericPart)) == 36*4) { // max value is ZZZZ9
        $alphaIndex += 1;
        if ($alphaIndex >= 26) {
            $alphaIndex = 0;
            $codeLength += 1;
        }
        $numericPart = array_fill(0, $codeLength-1, '0');
    }
    else {
        for ($i = count($numericPart) - 1; $i >= 0; $i--) {
            $currentNum = intval($numericPart[$i]) + $increment;
            if ($currentNum > 36 - 1) { // 36 is the number of digits and letters
                $increment = 1;
                $currentNum = 0;
            }
            else {
                $increment = 0;
            }
            $numericPart[$i] = base_convert($currentNum, 10, 36);
            if ($increment == 0) {
                break;
            }
        }
    }
    
    // Combine the parts of the code
    $alphaPart = '';
    if ($codeLength > 1) {
        $alphaPart = $alphabet[$alphaIndex];
    }
    $numericPart = str_pad(implode('', $numericPart), 4, '0', STR_PAD_LEFT);
    return $alphaPart . $numericPart;
}



function getNextCode($lastCode) {
    $letters = range('A', 'Z');
    $lastLetterIndex = 0;
    $lastNumberIndex = 4;

    // determina l'indice dell'ultima lettera e dell'ultimo numero in $lastCode
    for ($i = 0; $i < strlen($lastCode); $i++) {
        if (ctype_alpha($lastCode[$i])) {
            $lastLetterIndex = $i;
        } else {
            $lastNumberIndex = $i - 1;
            break;
        }
    }

    $lastLetter = strtoupper($lastCode[$lastLetterIndex]);
    $lastNumbers = substr($lastCode, $lastLetterIndex + 1);
    $newNumbers = str_pad((intval($lastNumbers) + 1), 4, '0', STR_PAD_LEFT);

    if ($lastNumbers == '9999') {
        if ($lastLetter == 'Z') {
            // passa alla combinazione successiva
            $newLetter = 'A';
            for ($i = $lastLetterIndex - 1; $i >= 0; $i--) {
                $currentLetter = strtoupper($lastCode[$i]);
                if ($currentLetter != 'Z') {
                    $newLetter = ++$currentLetter;
                    break;
                }
            }
            $newCode = $newLetter . str_repeat('A', 4);
        } else {
            // passa alla lettera successiva
            $newLetter = ++$lastLetter;
            $newCode = $newLetter . '0000';
        }
    } else {
        $newCode = $lastLetter . $newNumbers;
    }

    return $newCode;
}


function getNextCode($lastCode) {
    // separa la stringa in due parti: una con le lettere e l'altra con i numeri
    $letters = preg_replace('/[^A-Z]/', '', $lastCode);
    $numbers = preg_replace('/[^0-9]/', '', $lastCode);
    
    // se la stringa di numeri è vuota, inizia da 0
    if (empty($numbers)) {
      $numbers = '0';
    }
    
    // se tutti i numeri sono 9, incrementa le lettere e resetta i numeri a 0
    if (preg_match('/^9+$/', $numbers)) {
      if (empty($letters)) {
        $letters = 'A';
      } else {
        $lastLetter = substr($letters, -1);
        if ($lastLetter === 'Z') {
          $letters .= 'A';
        } else {
          $nextLetter = chr(ord($lastLetter) + 1);
          $letters = substr_replace($letters, $nextLetter, -1);
        }
      }
      $numbers = '0';
    } else {
      // altrimenti incrementa i numeri
      $numbers = str_pad((intval($numbers) + 1), strlen($numbers), '0', STR_PAD_LEFT);
    }
    
    // combina le lettere e i numeri per ottenere il nuovo codice
    return $letters . $numbers;
  }

function generateCode($lastCode) {
    $alphabet = range('A', 'Z'); // array con tutte le lettere dell'alfabeto
    $codeLength = strlen($lastCode); // lunghezza del codice precedente
    $lastLetter = substr($lastCode, 0, 1); // estrae la prima lettera del codice precedente
    $lastNumbers = substr($lastCode, 1); // estrae i numeri del codice precedente
    
    // verifica se il codice precedente è l'ultimo possibile
    if ($lastLetter == 'Z' && $lastNumbers == str_repeat('9', $codeLength-1)) {
      $newCode = 'A' . str_repeat('0', $codeLength);
      return $newCode;
    }
    
    // verifica se i numeri del codice precedente sono l'ultimo possibile
    if ($lastNumbers == str_repeat('9', $codeLength-1)) {
      $newLetter = $alphabet[array_search($lastLetter, $alphabet)+1]; // calcola la nuova lettera
      $newCode = $newLetter . str_repeat('0', $codeLength-1); // inizializza i numeri a 0
      return $newCode;
    }
    
    // incrementa i numeri del codice precedente di 1
    $newNumbers = strval(intval($lastNumbers) + 1);
    $padding = str_repeat('0', $codeLength-1 - strlen($newNumbers));
    $newCode = $lastLetter . $padding . $newNumbers;
    return $newCode;
  }*/
  ?>