import { useState, useEffect } from 'react';

type AddFunctionType = ((num1: number, num2: number) => number) | undefined;

const useWasm = () => {
  const [addFunction, setAddFunction] = useState<AddFunctionType>(undefined);

  useEffect(() => {
    const loadWasm = async () => {
      try {
        const wasmArrayBuffer = await fetch('/debug.wasm').then(response => response.arrayBuffer());
        const wasmModule = await WebAssembly.instantiate(wasmArrayBuffer);
        const add: AddFunctionType = wasmModule.instance.exports.add as unknown as AddFunctionType;
        setAddFunction(() => add);
      } catch (error) {
        console.error('Error loading wasm module:', error);
      }
    };

    loadWasm();
  }, []);

  return { addFunction };
};

export { useWasm };
